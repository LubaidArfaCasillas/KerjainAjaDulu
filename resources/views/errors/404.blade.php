{{-- ============================================================ --}}
{{-- FILE: resources/views/errors/404.blade.php                  --}}
{{-- ============================================================ --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/pages.css') }}">
</head>
<body>
<div class="error-page">
    <div class="error-page__code">404</div>
    <h1 class="error-page__title">Halaman tidak ditemukan</h1>
    <p class="error-page__desc">
        Halaman yang kamu cari tidak ada atau sudah dipindahkan.
    </p>
    <div style="display:flex; gap:12px;">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">🏠 Ke Board</a>
    </div>
</div>
</body>
</html>