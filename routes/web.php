<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ── Tasks (Board) ──────────────────────────────────────────
    Route::get('/',                 [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create',     [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks',           [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/search',     [TaskController::class, 'search'])->name('tasks.search');
    Route::get('/tasks/archive',    [TaskController::class, 'archive'])->name('tasks.archive');
    Route::get('/tasks/{task}',     [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/{task}/edit',[TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}',     [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}',  [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::put('/tasks/{task}/archive', [TaskController::class, 'archiveTask'])->name('tasks.archive-task');
    Route::put('/tasks/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

    // ── Comments ───────────────────────────────────────────────
    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('tasks.comments.store');

    // ── Dashboard ──────────────────────────────────────────────
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── Team ───────────────────────────────────────────────────
    Route::get('/team', [TeamController::class, 'index'])->name('team.index');

    // ── Notifications ──────────────────────────────────────────
    Route::get('/notifications',        [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('notifications.read-all');

    // ── Settings ───────────────────────────────────────────────
    Route::get('/settings',    [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings',    [SettingsController::class, 'update'])->name('settings.update');

    // ── Account ────────────────────────────────────────────────
    Route::get('/account',             [AccountController::class, 'index'])->name('account');
    Route::put('/account',             [AccountController::class, 'update'])->name('account.update');
    Route::put('/account/password',    [AccountController::class, 'updatePassword'])->name('account.password');
});