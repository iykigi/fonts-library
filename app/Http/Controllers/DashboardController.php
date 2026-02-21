<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fonts;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Visitor;
use Illuminate\Support\Str;
use App\Models\User;

class DashboardController extends Controller
{
    // داشبۆرد
    public function dashboard(Request $request)
    {
        $userId = auth()->id();
        $search = $request->input('search');

        // Base query for user fonts
        $query = Fonts::where('user_id', $userId);

// Search functionality
if ($search) {
    $query->where(function($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('code', 'like', "%{$search}%")
          ->orWhere('style', 'like', "%{$search}%"); // ئەمەش زیاد بکە ئەگەر دەتەوێت
    });
}

        // Paginate fonts
        $fonts = $query->select('id', 'name', 'code', 'style','downloads', 'description', 'file_path', 'updated_at', 'created_at')
               ->orderBy('created_at', 'desc')
               ->paginate(10);

        // Counts
        $oneYearAgo = Carbon::now()->subYear();
        $counts = Fonts::where('user_id', $userId)
                       ->selectRaw("
                            COUNT(*) as total,
                            SUM(CASE WHEN created_at >= ? THEN 1 ELSE 0 END) as yearly,
                            SUM(CASE WHEN updated_at >= ? AND updated_at != created_at THEN 1 ELSE 0 END) as updated
                        ", [$oneYearAgo, $oneYearAgo])
                       ->first();

        $fontsCount = $counts->total;
        $yearlyFontsCount = $counts->yearly;
        $updatedFontsCount = $counts->updated;

        // Latest updated fonts (cache 60 minutes)
        $latestFonts = Cache::remember("latestFonts_user_$userId", 60, function () use ($userId) {
            return Fonts::where('user_id', $userId)
                        ->orderBy('updated_at', 'desc')
                        ->take(4)
                        ->get();
        });

        // Latest created fonts (cache 60 minutes)
        $latestestFonts = Cache::remember("latestestFonts_user_$userId", 60, function () use ($userId) {
            return Fonts::where('user_id', $userId)
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
        });

        // Visitor stats
        $todayVisitors = Visitor::whereDate('created_at', Carbon::today())->count();
        $weeklyVisitors = Visitor::whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->count();
        $monthlyVisitors = Visitor::whereMonth('created_at', Carbon::now()->month)
                                  ->whereYear('created_at', Carbon::now()->year)
                                  ->count();
        $yearlyVisitors = Visitor::whereYear('created_at', Carbon::now()->year)->count();
        $totalVisitors = Visitor::count();

        return view('dashboard', compact(
            'fonts',
            'fontsCount',
            'yearlyFontsCount',
            'updatedFontsCount',
            'latestFonts',
            'latestestFonts',
            'todayVisitors',
            'weeklyVisitors',
            'monthlyVisitors',
            'yearlyVisitors',
            'totalVisitors'
        ));
    }

    // سڕینەوەی فۆنت
    public function destroy($id)
    {
        $userId = auth()->id();
        $font = Fonts::where('id', $id)->where('user_id', $userId)->firstOrFail();

        // Delete file if exists
        if ($font->file_path && Storage::disk('public')->exists($font->file_path)) {
            Storage::disk('public')->delete($font->file_path);
        }

        // Delete the font record
        $font->delete();

        return redirect()->route('dashboard')->with('success', 'Font and its file deleted successfully');
    }

   public function edit($id)
{
    $userId = auth()->id();

    // Get the font of the logged-in user
    $font = Fonts::where('id', $id)
                 ->where('user_id', $userId)
                 ->firstOrFail();

    return view('fonts.edit', compact('font'));
}


    public function update(Request $request, $id)
{
    $userId = auth()->id();
    $font = Fonts::where('id', $id)->where('user_id', $userId)->firstOrFail();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50',
        'font_file' => 'nullable|file|max:51200', // 50 MB
        'description' => 'nullable|string',
        'style' => 'nullable|string|max:100',
    ]);

    $font->fill($validated);

    if ($request->hasFile('font_file')) {
        $file = $request->file('font_file');
        $extension = strtolower($file->getClientOriginalExtension());

        // فولدەری یەکسانی یوسەر
        $randomFolder = Str::random(rand(8,12));
        $userFolder = 'fonts/user_' . $randomFolder;
        Storage::disk('public')->makeDirectory($userFolder);

        // پاککردنی فایلە کۆنەکان
        if ($font->file_path && Storage::disk('public')->exists($font->file_path)) {
            Storage::disk('public')->delete($font->file_path);
        }

        // دروستکردنی ناوی فایلەکە بە شێوەی رەندۆم (8-12 رەندۆم)
        $randomLength = rand(8, 12);
        $randomName = Str::random($randomLength);
        $fileName = $randomName . '.' . $extension;

        $path = $file->storeAs($userFolder, $fileName, 'public');

        if (!Storage::disk('public')->exists($path)) {
            return back()->with('error', 'کێشەیەک ڕوویدا لە پاشەکەوتکردنی فۆنت');
        }

        $font->file_path = $path;
    }

    $font->save();

    return redirect()->route('dashboard')->with('success', 'فۆنتەکە بە سەرکەوتوویی نوێکرایەوە');
}

    public function store(Request $request)
{
    $userId = auth()->id();

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:fonts,code',
        'description' => 'nullable|string',
        'file_path' => 'required|file|max:51200',
        'style' => 'nullable|string|max:100',
    ]);

    if ($request->hasFile('file_path')) {
        $file = $request->file('file_path');
        $extension = strtolower($file->getClientOriginalExtension());
        $cleanCode = Str::slug($validated['code']);

        // فولدەری تایبەتی یوزەر بە random string
        $randomFolder = Str::random(rand(8,12));
        $userFolder = 'fonts/user_' . $randomFolder;
        Storage::disk('public')->makeDirectory($userFolder);

        // ناوی فایل ستاندارد
        $fileName = $cleanCode . '_' . time() . '.' . $extension;

        // پاشەکەوتکردن
        $path = $file->storeAs($userFolder, $fileName, 'public');

        if (!Storage::disk('public')->exists($path)) {
            return back()->with('error', 'کێشەیەک ڕوویدا لە پاشەکەوتکردنی فۆنت');
        }

        $validated['file_path'] = $path;
        $validated['user_folder'] = $randomFolder; // ڕاندۆم فولدەری هەڵگرتن بۆ update
    }

    $validated['user_id'] = $userId;

    Fonts::create($validated);

    return redirect()->route('dashboard')
        ->with('success', 'فۆنتەکە بە سەرکەوتوویی زیاد کرا');
}


   public function destroyUser($userId)
{
    $user = User::findOrFail($userId);

    // پیدا کردن هەموو فولدەری فۆنتەکان
    $userFolders = Storage::disk('public')->allDirectories('fonts');

    foreach ($userFolders as $folder) {
        if (Str::contains($folder, "user_{$user->id}")) {
            // رەش کردن فولدەری یوزەر (prepend dot)
            $pathParts = explode('/', $folder);
            $lastPart = array_pop($pathParts);
            $newFolderName = '.' . $lastPart; // dot برای مخفی کردن
            $newFolderPath = implode('/', $pathParts) . '/' . $newFolderName;

            if (!Storage::disk('public')->exists($newFolderPath)) {
                Storage::disk('public')->move($folder, $newFolderPath);
            }
        }
    }

    // سڕینەوەی هەموو فۆنتەکان لە دیتابەیس
    Fonts::where('user_id', $user->id)->delete();

    // سڕینەوەی یوزەر
    $user->delete();

    return redirect()->back()->with('success', 'User and all their fonts/files hidden and deleted from DB successfully.');
}
}
