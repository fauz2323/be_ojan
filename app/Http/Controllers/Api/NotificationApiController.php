<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function getNotification()
    {
        $notification = Notification::all();
        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function getNotificationById($id)
    {
        $notification = Notification::find($id);
        return response()->json([
            'notification' => $notification,
        ]);
    }
}
