{{-- ============================================================ --}}
{{-- FILE: resources/views/account/index.blade.php               --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Account — TaskFlow')
@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Account</h1>
    </div>
</div>

<div style="max-width: 640px; display: flex; flex-direction: column; gap: 20px;">

    {{-- Profile card --}}
    <div class="card">
        <div class="card-header"><h3>Profil</h3></div>
        <div class="card-body">
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

            <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                <div class="avatar avatar-xl avatar-primary">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-size:1.0625rem; font-weight:700;">{{ auth()->user()->name }}</div>
                    <div style="font-size:0.875rem; color: var(--color-text-muted);">{{ auth()->user()->email }}</div>
                    <span class="badge badge-primary" style="margin-top:6px;">{{ auth()->user()->role ?? 'Member' }}</span>
                </div>
            </div>

            <form action="{{ route('account.update') }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="name">Nama</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control"
                           value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="role">Role</label>
                    <input type="text" id="role" name="role" class="form-control"
                           value="{{ old('role', auth()->user()->role) }}" placeholder="Contoh: Developer, Designer...">
                </div>

                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">Simpan Profil</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Password card --}}
    <div class="card">
        <div class="card-header"><h3>Ganti Password</h3></div>
        <div class="card-body">
            <form action="{{ route('account.password') }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="current_password">Password Sekarang</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                    @error('current_password')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="new_password">Password Baru</label>
                        <input type="password" id="new_password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Danger zone --}}
    <div class="card" style="border-color: var(--color-danger-light);">
        <div class="card-header" style="background: var(--color-danger-light);">
            <h3 style="color: var(--color-danger);">Danger Zone</h3>
        </div>
        <div class="card-body">
            <p style="font-size:0.875rem; color: var(--color-text-muted); margin-bottom:16px;">
                Setelah akun dihapus, semua data akan hilang permanen.
            </p>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-secondary">Logout</button>
            </form>
        </div>
    </div>
</div>
@endsection