<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserSetting;

class SettingsController extends Controller
{
    public function index()
    {
        $user     = Auth::user();
        $record   = UserSetting::firstOrCreate(['user_id' => $user->id]);
        $settings = json_decode($record->settings ?? '{}', true) ?? [];

        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = [
            'notif_assigned' => $request->boolean('notif_assigned'),
            'notif_comment'  => $request->boolean('notif_comment'),
            'notif_deadline' => $request->boolean('notif_deadline'),
            'default_view'   => $request->input('default_view', 'board'),
        ];

        UserSetting::updateOrCreate(
            ['user_id' => Auth::id()],
            ['settings' => json_encode($settings)]
        );

        return redirect()->route('settings')
                         ->with('success', 'Settings berhasil disimpan!');
    }
}