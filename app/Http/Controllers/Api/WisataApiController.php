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

    public function getWisataById($id)
    {
        $wisata = Wisata::find($id);
        if ($wisata->clicks) {
            $wisata->clicks->user_click = $wisata->clicks->user_click + 1;
            $wisata->clicks->save();
            # code...
        } else {
            $click = new WisataClick();
            $click->user_click = 1;
            $click->save();
        }
        return response()->json([
            'wisata' => $wisata,
            'info' => $wisata->info,
            'views' => $wisata->clicks,
        ]);
    }

    public function getWisataByCategory(Request $request)
    {
        $wisata = Wisata::where('wisata_category_id', $request->id)->get();
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
