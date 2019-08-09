<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function update($id)
    {
        $notification = auth()->user()->notifications()->find($id);
        if ($notification) {
            $notification->markAsRead();

            return response()->json([
                'message' => 'Read',
                ], 200);
        }
    }
}
