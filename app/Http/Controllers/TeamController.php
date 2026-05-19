<?php

// ================================================================
// FILE: app/Http/Controllers/TeamController.php
// ================================================================
namespace App\Http\Controllers;

use App\Models\User;

class TeamController extends Controller
{
    public function index()
    {
        $users = User::with(['tasks' => fn($q) => $q->active()])
                     ->orderBy('name')
                     ->get();

        return view('team.index', compact('users'));
    }
}


// ================================================================
// FILE: app/Http/Controllers/NotificationController.php
// ================================================================
// (File terpisah di project nyata, ini digabung untuk ringkas)

// ================================================================
// FILE: app/Http/Controllers/SettingsController.php
// ================================================================

// ================================================================
// FILE: app/Http/Controllers/AccountController.php
// ================================================================