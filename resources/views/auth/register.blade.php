<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — KerjainAjaDulu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>
<body>
<div class="login-center-wrap">
    <div class="login-card">
        <div class="login-logo">
            <div class="login-logo-icon">K</div>
            <span class="login-logo-text">KerjainAjaDulu</span>
        </div>
        <h1 class="login-title">Buat Akun Baru</h1>
        <p class="login-sub">Gratis selamanya, mulai sekarang 🚀</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap <span>*</span></label>
                <input type="text" id="name" name="name" class="form-control"
                       placeholder="Nama kamu" value="{{ old('name') }}" required autofocus>
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="nama@email.com" value="{{ old('email') }}" required>
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password <span>*</span></label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Minimal 8 karakter" required>
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password <span>*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-control" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="padding:11px;margin-top:4px;">Buat Akun</button>
        </form>
        <p class="login-footer">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
        <p style="text-align:center;margin-top:12px;font-size:12px;color:var(--text-hint);">
            <a href="{{ route('landing') }}" style="color:var(--text-hint);">← Kembali ke Beranda</a>
        </p>
    </div>
</div>
</body>
</html>