<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VersionApps;
use Illuminate\Http\Request;

class VersionAdminController extends Controller
{
    public function getVersion()
    {
        $version = VersionApps::first();
    }

    public function setVersion(Request $request)
    {
        $request->validate([
            'version' => 'required',
        ]);

        $version = VersionApps::first();
        $version->version = $request->version;
        $version->save();

        return redirect()->back()->with('success', 'Version berhasil diubah');
    }
}
