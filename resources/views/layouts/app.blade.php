<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KerjainAjaDulu')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @stack('styles')
</head>
<body>

{{-- ===== MOBILE NAVBAR (hanya muncul di HP) ===== --}}
<div class="mobile-nav">
    <div class="mobile-nav__logo">
        <div class="mobile-nav__logo-icon">K</div>
        <span class="mobile-nav__logo-text">KerjainAjaDulu</span>
    </div>
    <button class="mobile-nav__hamburger" id="hamburgerBtn" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</div>

{{-- Overlay gelap saat sidebar terbuka di mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="app-wrapper">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar__logo">
            <div class="sidebar__logo-icon">K</div>
            <span class="sidebar__logo-text">KerjainAjaDulu</span>
        </div>

        <nav class="sidebar__nav">
            <span class="sidebar__section-label">Menu</span>

            <a href="{{ route('tasks.index') }}"
               class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-layout-kanban"></i></span>
                Project Board
            </a>

            <a href="{{ route('tasks.search') }}"
               class="{{ request()->routeIs('tasks.search') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-search"></i></span>
                Cari & Filter
            </a>

            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-chart-bar"></i></span>
                Progress
            </a>

            <a href="{{ route('team.index') }}"
               class="{{ request()->routeIs('team.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-users"></i></span>
                Tim
            </a>

            <span class="sidebar__section-label">Lainnya</span>

            <a href="{{ route('notifications') }}"
               class="{{ request()->routeIs('notifications') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-bell"></i></span>
                Notifikasi
                @if(isset($unreadNotifs) && $unreadNotifs > 0)
                    <span class="sidebar__nav-badge">{{ $unreadNotifs }}</span>
                @endif
            </a>

            <a href="{{ route('tasks.archive') }}"
               class="{{ request()->routeIs('tasks.archive') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-archive"></i></span>
                Arsip
            </a>
        </nav>

        <div class="sidebar__bottom">
            <a href="{{ route('settings') }}"
               class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-settings"></i></span>
                Pengaturan
            </a>
            <a href="{{ route('account') }}"
               class="{{ request()->routeIs('account') ? 'active' : '' }}">
                <span class="nav-icon"><i class="ti ti-user"></i></span>
                Akun
            </a>

            <div class="sidebar__user">
                <div class="avatar avatar-sm avatar-primary">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="sidebar__user-info">
                    <div class="sidebar__user-name">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="sidebar__user-role">{{ auth()->user()->role ?? 'Member' }}</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="page-content">
        @if(session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

</div>

@stack('scripts')
<script>
    // Hamburger toggle sidebar di mobile
    const hamburgerBtn  = document.getElementById('hamburgerBtn');
    const sidebar       = document.getElementById('sidebar');
    const overlay       = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('open');
        overlay.classList.add('active');
        hamburgerBtn.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
        hamburgerBtn.classList.remove('open');
        document.body.style.overflow = '';
    }

    hamburgerBtn.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });

    // Tutup sidebar saat klik overlay
    overlay.addEventListener('click', closeSidebar);

    // Tutup sidebar saat klik link di mobile
    sidebar.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) closeSidebar();
        });
    });

    // Dropdown toggle
    document.querySelectorAll('[data-toggle="dropdown"]').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            this.nextElementSibling.classList.toggle('open');
        });
    });
    document.addEventListener('click', () => {
        document.querySelectorAll('.dropdown-menu.open').forEach(m => m.classList.remove('open'));
    });
</script>
</body>
</html>