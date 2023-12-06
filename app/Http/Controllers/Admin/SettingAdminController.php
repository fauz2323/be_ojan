<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VersionApps;
use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    public function index()
    {
        $version = VersionApps::first();
        return view('admin.setting.index', compact('version'));
    }
}
