<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use App\Models\WisataCategory;
use Illuminate\Http\Request;

class WisataApiController extends Controller
{
    public function getWisata()
    {
        $wisata = Wisata::all();
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getWisataById($id)
    {
        $wisata = Wisata::find($id);
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getWisataByCategory($id)
    {
        $wisata = Wisata::where('wisata_category_id', $id)->get();
        return response()->json([
            'wisata' => $wisata,
        ]);
    }

    public function getWisataCategory()
    {
        $category = WisataCategory::all();
        return response()->json([
            'category' => $category,
        ]);
    }
}
