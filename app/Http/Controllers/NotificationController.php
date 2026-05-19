<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        // Menggunakan fitur notifikasi bawaan Laravel
        $notifications = Auth::user()
                             ->notifications()
                             ->latest()
                             ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    public function readAll()
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->route('notifications')
                         ->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}