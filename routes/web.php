<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('tasks.index');
    }
    return view('landing');
})->name('landing');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'login'])->name('login.post');
    Route::get('/register',  [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Tasks
    Route::get('/board',                [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tugas/tambah',         [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tugas',               [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tugas/cari',           [TaskController::class, 'search'])->name('tasks.search');
    Route::get('/tugas/arsip',          [TaskController::class, 'archive'])->name('tasks.archive');
    Route::get('/tugas/{task}',         [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/tugas/{task}/edit',    [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tugas/{task}',         [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tugas/{task}',      [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::put('/tugas/{task}/arsip',   [TaskController::class, 'archiveTask'])->name('tasks.archive-task');
    Route::put('/tugas/{task}/restore', [TaskController::class, 'restore'])->name('tasks.restore');

    // Comments
    Route::post('/tugas/{task}/komentar', [CommentController::class, 'store'])->name('tasks.comments.store');

    // Dashboard
    Route::get('/progress', [DashboardController::class, 'index'])->name('dashboard');

    // Team
    Route::get('/tim', [TeamController::class, 'index'])->name('team.index');

    // Settings
    Route::get('/pengaturan', [SettingsController::class, 'index'])->name('settings');
    Route::put('/pengaturan', [SettingsController::class, 'update'])->name('settings.update');

    // Account
    Route::get('/akun', [AccountController::class, 'index'])->name('account');
    Route::put('/akun', [AccountController::class, 'update'])->name('account.update');
});