@extends('layouts.app')
@section('title', 'Akun — KerjainAjaDulu')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Akun</h1>
        <p class="page-subtitle">Kelola informasi profil kamu.</p>
    </div>
</div>

<div style="max-width: 560px;">
    <div class="card">
        <div class="card-header"><h3>Profil</h3></div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            {{-- Avatar --}}
            <div style="display:flex;align-items:center;gap:16px;margin-bottom:24px;padding:16px;background:var(--bg);border-radius:var(--r-lg);">
                <div class="avatar avatar-xl avatar-primary">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-size:1rem;font-weight:700;color:var(--text);">{{ auth()->user()->name }}</div>
                    <div style="font-size:13px;color:var(--text-muted);margin-top:2px;">{{ auth()->user()->email }}</div>
                    <span class="badge badge-primary" style="margin-top:8px;">{{ auth()->user()->role ?? 'Member' }}</span>
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
                    <label class="form-label" for="role">Role / Jabatan</label>
                    <input type="text" id="role" name="role" class="form-control"
                           value="{{ old('role', auth()->user()->role) }}"
                           placeholder="Contoh: Developer, Designer, QA...">
                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px;flex-wrap:wrap;gap:10px;">
                    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="btn btn-secondary">
                            <i class="ti ti-logout"></i> Logout
                        </button>
                    </form>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection