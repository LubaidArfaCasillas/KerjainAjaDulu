<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KerjainAjaDulu')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    @stack('styles')
</head>
<body>

{{-- Mobile Navbar --}}
<div class="mobile-nav">
    <div class="mobile-nav__logo">
        <div class="mobile-nav__logo-icon">K</div>
        <span class="mobile-nav__logo-text">KerjainAjaDulu</span>
    </div>
    <button class="mobile-nav__hamburger" id="hamburgerBtn">
        <span></span><span></span><span></span>
    </button>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<div class="app-wrapper">

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        {{-- Header sidebar mobile (tampil saat hamburger) --}}
        <div class="sidebar__logo sidebar__mobile-header">
            <div style="display:flex;align-items:center;gap:9px;flex:1;">
                <div class="sidebar__logo-icon">K</div>
                <span class="sidebar__logo-text">KerjainAjaDulu</span>
            </div>
            <button id="sidebarCloseBtn" style="background:none;border:none;cursor:pointer;padding:4px;color:#738496;font-size:20px;line-height:1;">✕</button>
        </div>

        <nav class="sidebar__nav">
            <span class="sidebar__section-label">Menu Utama</span>

            <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.index') ? 'active' : '' }}">
                <i class="ti ti-layout-kanban"></i> Project Board
            </a>
            <a href="{{ route('tasks.search') }}" class="{{ request()->routeIs('tasks.search') ? 'active' : '' }}">
                <i class="ti ti-search"></i> Cari & Filter
            </a>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="ti ti-chart-bar"></i> Progress
            </a>
            <a href="{{ route('team.index') }}" class="{{ request()->routeIs('team.*') ? 'active' : '' }}">
                <i class="ti ti-users"></i> Tim
            </a>

            <span class="sidebar__section-label">Lainnya</span>

            <a href="{{ route('tasks.archive') }}" class="{{ request()->routeIs('tasks.archive') ? 'active' : '' }}">
                <i class="ti ti-archive"></i> Arsip
            </a>
        </nav>

        <div class="sidebar__bottom">
            <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}">
                <i class="ti ti-settings"></i> Pengaturan
            </a>
            <a href="{{ route('account') }}" class="sidebar__user {{ request()->routeIs('account') ? 'active' : '' }}">
                <div class="avatar avatar-sm avatar-primary">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 2)) }}
                </div>
                <div class="sidebar__user-info">
                    <div class="sidebar__user-name">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="sidebar__user-role">{{ auth()->user()->role ?? 'Member' }}</div>
                </div>
            </a>
        </div>
    </aside>

    {{-- Main Content --}}
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
const hamburgerBtn = document.getElementById('hamburgerBtn');
const sidebarCloseBtn = document.getElementById('sidebarCloseBtn');
const sidebar      = document.getElementById('sidebar');
const overlay      = document.getElementById('sidebarOverlay');

function openSidebar() {
    sidebar.classList.add('open');
    overlay.classList.add('active');
    hamburgerBtn.classList.add('open');
    // Simpan posisi scroll saat ini lalu fikasikan body
    const scrollY = window.scrollY;
    document.body.style.position = 'fixed';
    document.body.style.top = `-${scrollY}px`;
    document.body.style.width = '100%';
}
function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    hamburgerBtn.classList.remove('open');
    // Kembalikan scroll ke posisi semula
    const scrollY = document.body.style.top;
    document.body.style.position = '';
    document.body.style.top = '';
    document.body.style.width = '';
    window.scrollTo(0, parseInt(scrollY || '0') * -1);
}

hamburgerBtn.addEventListener('click', () => sidebar.classList.contains('open') ? closeSidebar() : openSidebar());
if (sidebarCloseBtn) sidebarCloseBtn.addEventListener('click', closeSidebar);
overlay.addEventListener('click', closeSidebar);
sidebar.querySelectorAll('a').forEach(l => l.addEventListener('click', () => { if (window.innerWidth <= 768) closeSidebar(); }));
document.querySelectorAll('[data-toggle="dropdown"]').forEach(btn => { btn.addEventListener('click', function(e) { e.stopPropagation(); this.nextElementSibling.classList.toggle('open'); }); });
document.addEventListener('click', () => document.querySelectorAll('.dropdown-menu.open').forEach(m => m.classList.remove('open')));
</script>
</body>
</html>