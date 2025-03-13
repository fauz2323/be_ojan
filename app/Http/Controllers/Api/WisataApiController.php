<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\WisataCategory;
use App\Models\WisataClick;
use Illuminate\Http\Request;

class WisataApiController extends Controller
{
    public function getWisata()
    {
        $wisata = Wisata::with('image')->get();
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getWisataById(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $wisata = Wisata::with('image', 'clicks', 'info', 'kategori')->where('id', $request->id)->first();

        return response()->json([
            'detail' => $wisata,
        ]);
    }

    public function getWisataByCategory(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $wisata = Wisata::where('wisata_category_id', $request->id)->with('image')->get();
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getWisataByCategoryName(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = WisataCategory::where('category', $request->name)->first();

        $wisata = Wisata::where('wisata_category_id', $category->id)->with('image')->get();
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getCategory()
    {
        $category = WisataCategory::all();
        return response()->json([
            'category' => $category,
        ]);
    }
}
