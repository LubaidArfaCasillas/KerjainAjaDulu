<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login — TaskFlow</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>
<body>

<div class="auth-wrapper" style="justify-content: center; align-items: center; background-color: #f4f6f8; padding: 20px;">

    {{-- Center: Form Card --}}
    <div class="auth-left" style="border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); height: auto; padding: 48px;">
        <div class="auth-logo">
            <div class="auth-logo__icon">⬡</div>
            <span class="auth-logo__text">TaskFlow</span>
        </div>

        <h1 class="auth-title">Selamat datang kembali</h1>
        <p class="auth-subtitle">Masuk ke akun kamu untuk melanjutkan mengelola tugas.</p>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="auth-form" action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label" for="email">Email <span>*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control @error('email') is-error @enderror"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}"
                    required
                    autofocus>
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="password">
                    Password <span>*</span>
                    <a href="#" style="float:right; font-weight:500; color: var(--color-primary); font-size:0.8125rem;">Lupa password?</a>
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group" style="flex-direction:row; align-items:center; gap:8px;">
                <input type="checkbox" id="remember" name="remember" style="width:16px;height:16px;cursor:pointer;">
                <label for="remember" style="font-size:0.875rem; color: var(--color-text-muted); cursor:pointer; margin:0;">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="margin-top:8px;">
                Masuk
            </button>
        </form>

        <p class="auth-footer-text">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>

</div>

</body>
</html>