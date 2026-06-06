<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — KerjainAjaDulu</title>
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
        <h1 class="login-title">Masuk ke Akun</h1>
        <p class="login-sub">Selamat datang kembali 👋</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">Email <span>*</span></label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password <span>*</span></label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Masukkan password" required>
                @error('password')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div style="display:flex;align-items:center;gap:8px;margin-bottom:20px;">
                <input type="checkbox" id="remember" name="remember" style="width:15px;height:15px;cursor:pointer;">
                <label for="remember" style="font-size:13px;color:var(--text-muted);cursor:pointer;margin:0;">Ingat saya</label>
            </div>
            <button type="submit" class="btn btn-primary w-100" style="padding:11px;">Masuk</button>
        </form>
        <p class="login-footer">Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        <p style="text-align:center;margin-top:12px;font-size:12px;color:var(--text-hint);">
            <a href="{{ route('landing') }}" style="color:var(--text-hint);">← Kembali ke Beranda</a>
        </p>
    </div>
</div>
</body>
</html>