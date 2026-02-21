<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fonts;

class FontController extends Controller
{
    public function allFonts(Request $request)
    {
        $fonts = Fonts::select(
                        'id',
                        'name',
                        'code',
                        'style',
                        'description',
                        'file_path',
                        'updated_at',
                        'created_at'
                    )
                    ->paginate(50);

        return response()->json([
            'success' => true,
            'data' => $fonts->items(),
            'pagination' => [
                'current_page' => $fonts->currentPage(),
                'last_page' => $fonts->lastPage(),
                'per_page' => $fonts->perPage(),
                'total' => $fonts->total(),
                'next_page_url' => $fonts->nextPageUrl(),
                'prev_page_url' => $fonts->previousPageUrl()
            ]
        ]);
    }
}
