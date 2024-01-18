<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenginapanController extends Controller
{
    function getAllPenginapan()
    {
        $data = Penginapan::with('image')->get();

        return response()->json([
            'message' => 'success get data',
            'penginapan' => $data
        ]);
    }

    function getNearbyPenginapan(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $latitude = $request->lat;
        $longitude = $request->lng;

        $data = Penginapan::select('*')
            ->selectRaw(
                "( 3959 * acos( cos( radians('$latitude') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( latitude ) ) ) ) AS distance"
            )
            ->having('distance', '>', 50)
            ->with('image')->get();

        return response()->json([
            'message' => 'success get data',
            'penginapan' => $data
        ]);
    }

    function getDetailPenginapan(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);

        $penginapan = Penginapan::with('image')->where('id', $request->id)->first();
        return response()->json([
            'message' => 'success get data',
            'detail' => $penginapan
        ]);
    }
}
