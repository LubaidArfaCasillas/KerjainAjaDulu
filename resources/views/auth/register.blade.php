<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar — TaskFlow</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/auth.css') }}">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-left">
        <div class="auth-logo">
            <div class="auth-logo__icon">⬡</div>
            <span class="auth-logo__text">TaskFlow</span>
        </div>

        <h1 class="auth-title">Buat akun baru</h1>
        <p class="auth-subtitle">Mulai kelola proyek dan tugas tim kamu secara gratis.</p>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form class="auth-form" action="{{ route('register.post') }}" method="POST">
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

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="password">Password <span>*</span></label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="Min. 8 karakter" required>
                    @error('password')<span class="form-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Konfirmasi Password <span>*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100" style="margin-top:4px;">
                Buat Akun
            </button>
        </form>

        <p class="auth-footer-text">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>

    <div class="auth-right">
        <div class="auth-right-content">
            <h2>Bergabung dengan ribuan tim produktif</h2>
            <p>TaskFlow membantu tim kamu tetap tersinkronisasi, on-track, dan deliver hasil lebih cepat.</p>
            <div class="auth-feature-list">
                <div class="auth-feature">
                    <div class="auth-feature__check">✓</div>
                    <span>Gratis untuk tim kecil</span>
                </div>
                <div class="auth-feature">
                    <div class="auth-feature__check">✓</div>
                    <span>Setup dalam 2 menit</span>
                </div>
                <div class="auth-feature">
                    <div class="auth-feature__check">✓</div>
                    <span>Tidak perlu kartu kredit</span>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>