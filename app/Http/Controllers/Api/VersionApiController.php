<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VersionApps;
use Illuminate\Http\Request;

class VersionApiController extends Controller
{
    public function getVersion()
    {
        $version = VersionApps::first();
        return response()->json([
            'version' => $version->version,
        ]);
    }
}
