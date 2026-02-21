<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fonts;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class FontsController extends Controller
{
    /**
     * Download font file securely and increment download count
     */
    public function download($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Invalid font ID.');
        }

        $font = Fonts::findOrFail($decryptedId);
        
        // زیادکردنی ژمارەی دابەزاندن
        $font->increment('downloads');
        
        // پاککردنەوەی cache بۆ ئەم فۆنتە
        Cache::forget("font_{$decryptedId}");
        Cache::forget('welcome_fonts');
        Cache::forget('popular_fonts');

        $disk = Storage::disk('public');
        $filePath = $font->file_path;

        if (!$filePath || !$disk->exists($filePath)) {
            return redirect()->back()->with('error', 'Font file not found.');
        }

        $fileName = basename($filePath);

        // Serve download securely with cache headers
        return response()->streamDownload(function () use ($disk, $filePath) {
            echo $disk->get($filePath);
        }, $fileName, [
            'Content-Type' => $disk->mimeType($filePath),
            'Cache-Control' => 'private, max-age=60',
        ]);
    }

    /**
     * Increment download count via AJAX
     */
    public function incrementDownload(Fonts $font)
    {
        $font->increment('downloads');
        
        // پاککردنەوەی cache
        Cache::forget("font_{$font->id}");
        Cache::forget('welcome_fonts');
        Cache::forget('popular_fonts');
        
        return response()->json([
            'success' => true,
            'downloads' => $font->downloads,
            'formatted_downloads' => $this->formatNumber($font->downloads)
        ]);
    }

    /**
     * Get download count via AJAX
     */
    public function getDownloadCount(Fonts $font)
    {
        return response()->json([
            'downloads' => $font->downloads ?? 0,
            'formatted_downloads' => $this->formatNumber($font->downloads ?? 0)
        ]);
    }

    /**
     * Format number to K, M format
     */
    private function formatNumber($number)
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return round($number / 1000, 1) . 'K';
        }
        return $number;
    }

    /**
     * Welcome page - show 6 random fonts (cached for 1 minute for speed)
     */
    public function index()
{
    $fonts = Cache::remember('welcome_fonts', 60, function () {
        return Fonts::orderBy('downloads', 'desc') // زۆرترین یەکەم
            ->take(6)
            ->get(['id', 'name', 'code', 'description', 'file_path', 'style', 'downloads']);
    });

    // کۆی گشتی دابەزاندنەکان
    $totalDownloads = Cache::remember('total_downloads', 60, function () {
        return Fonts::sum('downloads');
    });

    return view('welcome', compact('fonts', 'totalDownloads'));
}


    /**
     * Search fonts with filtering and pagination
     */
    public function search(Request $request)
    {
        $query = Fonts::query()->select('id', 'name', 'code', 'description', 'file_path', 'style', 'created_at', 'downloads');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // Style filter (multiple)
        if ($request->filled('style')) {
            $styles = is_array($request->style) ? $request->style : [$request->style];
            $query->whereIn('style', $styles);
        }

        // Sort options
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'popular':
                    $query->orderBy('downloads', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            // Order by newest and paginate 12 per page
            $query->orderBy('created_at', 'desc');
        }

        $fonts = $query->paginate(12);

        if ($request->ajax()) {
            if ($request->has('page')) {
                return view('font.partials.fonts', compact('fonts'))->render();
            }
            return response()->json([
                'html' => view('font.partials.fonts', compact('fonts'))->render(),
                'hasMore' => $fonts->hasMorePages()
            ]);
        }

        return view('font', compact('fonts'));
    }

    /**
     * Show single font details securely
     */
    public function show($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
            
            // Cache single font for 1 minute for performance
            $font = Cache::remember("font_{$decryptedId}", 60, function () use ($decryptedId) {
                return Fonts::with('user')->findOrFail($decryptedId);
            });

            // هێنانی فۆنتە پەیوەندیدارەکان (هەمان style)
            $relatedFonts = Cache::remember("related_fonts_{$font->style}_{$font->id}", 60, function () use ($font) {
                return Fonts::where('style', $font->style)
                    ->where('id', '!=', $font->id)
                    ->inRandomOrder()
                    ->take(4)
                    ->get(['id', 'name', 'code', 'downloads']);
            });

            // فۆنتە بەناوبانگەکان
            $popularFonts = Cache::remember('popular_fonts', 60, function () {
                return Fonts::orderBy('downloads', 'desc')
                    ->take(5)
                    ->get(['id', 'name', 'code', 'downloads']);
            });

            return view('page', compact('font', 'relatedFonts', 'popularFonts'));
            
        } catch (\Exception $e) {
            abort(404);
        }
    }

    /**
     * Get popular fonts
     */
    public function popular()
    {
        $fonts = Cache::remember('popular_fonts_page', 60, function () {
            return Fonts::orderBy('downloads', 'desc')
                ->paginate(12);
        });

        return view('fonts.popular', compact('fonts'));
    }

    /**
     * Get font statistics
     */
    public function statistics()
    {
        $stats = Cache::remember('font_statistics', 300, function () {
            return [
                'total_fonts' => Fonts::count(),
                'total_downloads' => Fonts::sum('downloads'),
                'most_downloaded' => Fonts::orderBy('downloads', 'desc')->first(),
                'styles_count' => Fonts::selectRaw('style, count(*) as count')
                    ->groupBy('style')
                    ->get()
            ];
        });

        return response()->json($stats);
    }
}