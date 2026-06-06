<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KerjainAjaDulu — Kelola Tugas Tim Lebih Mudah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

{{-- NAVBAR --}}
<header class="lp-navbar" id="lpNavbar">
    <div class="lp-container lp-navbar__inner">
        <a href="/" class="lp-navbar__logo">
            <div class="lp-navbar__logo-icon">K</div>
            <span>KerjainAjaDulu</span>
        </a>
        <nav class="lp-navbar__nav" id="lpNav">
            <a href="#fitur">Fitur</a>
            <a href="#cara-kerja">Cara Kerja</a>
            <a href="#testimoni">Testimoni</a>
        </nav>
        <div class="lp-navbar__actions">
            <a href="{{ route('login') }}" class="lp-btn lp-btn-ghost">Masuk</a>
            <a href="{{ route('register') }}" class="lp-btn lp-btn-primary">Daftar Gratis</a>
        </div>
        <button class="lp-hamburger" id="lpHamburger">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

{{-- HERO --}}
<section class="lp-hero">
    <div class="lp-container lp-hero__inner">
        <div class="lp-hero__content">
            <div class="lp-hero__badge">✨ Gratis untuk semua tim</div>
            <h1 class="lp-hero__title">
                Kerjain Semua Tugasmu<br>
                <span class="lp-hero__title-highlight">Lebih Mudah & Teratur</span>
            </h1>
            <p class="lp-hero__desc">
                Kelola tugas tim dengan board visual yang intuitif. Pantau progres, atur deadline, dan selesaikan lebih banyak pekerjaan bersama.
            </p>
            <div class="lp-hero__actions">
                <a href="{{ route('register') }}" class="lp-btn lp-btn-primary lp-btn-lg">
                    Mulai Gratis Sekarang →
                </a>
                <a href="#cara-kerja" class="lp-btn lp-btn-outline lp-btn-lg">
                    ▶ Lihat Cara Kerja
                </a>
            </div>
            <p class="lp-hero__note">Tidak perlu kartu kredit · Setup dalam 2 menit</p>
        </div>

        {{-- Board Preview --}}
        <div class="lp-hero__visual">
            <div class="lp-board-preview">
                <div class="lp-board-preview__header">
                    <div class="lp-board-preview__dot" style="background:#FF5F57"></div>
                    <div class="lp-board-preview__dot" style="background:#FFBD2E"></div>
                    <div class="lp-board-preview__dot" style="background:#28CA41"></div>
                    <span style="margin-left:8px;font-size:11px;color:#64748b;">KerjainAjaDulu — Project Board</span>
                </div>
                <div class="lp-board-preview__body">
                    <div class="lp-board-col">
                        <div class="lp-board-col__title"><span class="lp-dot" style="background:#8590A2"></span>Belum Dikerjakan</div>
                        <div class="lp-task-card">
                            <div class="lp-task-title">Desain halaman utama</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-high">Tinggi</span><span class="lp-task-avatar">AJ</span></div>
                        </div>
                        <div class="lp-task-card">
                            <div class="lp-task-title">Setup database schema</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-med">Sedang</span><span class="lp-task-avatar" style="background:#EDE9FE;color:#6D28D9">RD</span></div>
                        </div>
                    </div>
                    <div class="lp-board-col">
                        <div class="lp-board-col__title"><span class="lp-dot" style="background:#0052CC"></span>Dikerjakan</div>
                        <div class="lp-task-card lp-task-card--active">
                            <div class="lp-task-title">Integrasi API payment</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-high">Tinggi</span><span class="lp-task-avatar">AJ</span></div>
                        </div>
                        <div class="lp-task-card">
                            <div class="lp-task-title">Testing fitur login</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-low">Rendah</span><span class="lp-task-avatar" style="background:#D1FAE5;color:#065F46">SA</span></div>
                        </div>
                    </div>
                    <div class="lp-board-col">
                        <div class="lp-board-col__title"><span class="lp-dot" style="background:#22A06B"></span>Selesai</div>
                        <div class="lp-task-card" style="opacity:.6;">
                            <div class="lp-task-title" style="text-decoration:line-through;color:#94a3b8;">Setup project Laravel</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-done">Selesai</span></div>
                        </div>
                        <div class="lp-task-card" style="opacity:.6;">
                            <div class="lp-task-title" style="text-decoration:line-through;color:#94a3b8;">Buat wireframe awal</div>
                            <div class="lp-task-meta"><span class="lp-badge lp-badge-done">Selesai</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- STRIP --}}
<section class="lp-strip">
    <div class="lp-container">
        <p class="lp-strip__label">Cocok untuk berbagai tim</p>
        <div class="lp-strip__logos">
            <span>🚀 Startup</span>
            <span>💼 Freelancer</span>
            <span>🏢 Perusahaan</span>
            <span>🎓 Mahasiswa</span>
            <span>👨‍💻 Developer</span>
            <span>🎨 Designer</span>
        </div>
    </div>
</section>

{{-- FITUR --}}
<section class="lp-features" id="fitur">
    <div class="lp-container">
        <div class="lp-section-header">
            <div class="lp-section-badge">Fitur Unggulan</div>
            <h2 class="lp-section-title">Semua yang kamu butuhkan<br>dalam satu tempat</h2>
            <p class="lp-section-desc">Dari manajemen tugas hingga kolaborasi tim, semua sudah tersedia.</p>
        </div>
        <div class="lp-features__grid">
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#EEF2FF;color:#4F46E5;">📋</div>
                <h3>Project Board</h3>
                <p>Visualisasi tugas dengan 4 kolom: Belum Dikerjakan, Sedang Dikerjakan, Direview, dan Selesai.</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#FFF7ED;color:#EA580C;">⚡</div>
                <h3>Prioritas Tugas</h3>
                <p>Tandai setiap tugas dengan prioritas Tinggi, Sedang, atau Rendah agar tim tahu mana yang harus dikerjakan duluan.</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#F0FDF4;color:#16A34A;">👥</div>
                <h3>Manajemen Tim</h3>
                <p>Assign tugas ke anggota tim, pantau siapa mengerjakan apa, dan lihat progres semua orang.</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#FFF1F2;color:#E11D48;">📅</div>
                <h3>Deadline Tracker</h3>
                <p>Set deadline untuk setiap tugas dan dapatkan peringatan otomatis sebelum waktu habis.</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#EFF6FF;color:#2563EB;">📊</div>
                <h3>Dashboard Progres</h3>
                <p>Lihat statistik tugas selesai, yang sedang dikerjakan, dan yang terlambat dalam satu tampilan.</p>
            </div>
            <div class="lp-feature-card">
                <div class="lp-feature-icon" style="background:#FAF5FF;color:#7C3AED;">🔍</div>
                <h3>Cari & Filter</h3>
                <p>Temukan tugas dengan cepat menggunakan fitur pencarian dan filter berdasarkan status atau prioritas.</p>
            </div>
        </div>
    </div>
</section>

{{-- CARA KERJA --}}
<section class="lp-howto" id="cara-kerja">
    <div class="lp-container">
        <div class="lp-section-header">
            <div class="lp-section-badge">Cara Kerja</div>
            <h2 class="lp-section-title">Mulai dalam 3 langkah mudah</h2>
        </div>
        <div class="lp-steps">
            <div class="lp-step">
                <div class="lp-step__number">1</div>
                <div class="lp-step__content">
                    <h3>Daftar Akun</h3>
                    <p>Buat akun gratis dalam hitungan detik. Tidak perlu kartu kredit.</p>
                </div>
            </div>
            <div class="lp-step__arrow">→</div>
            <div class="lp-step">
                <div class="lp-step__number">2</div>
                <div class="lp-step__content">
                    <h3>Tambah Tugas</h3>
                    <p>Buat tugas, set prioritas, tentukan deadline, dan assign ke anggota tim.</p>
                </div>
            </div>
            <div class="lp-step__arrow">→</div>
            <div class="lp-step">
                <div class="lp-step__number">3</div>
                <div class="lp-step__content">
                    <h3>Pantau & Selesaikan</h3>
                    <p>Pindahkan tugas antar kolom sesuai progres dan pantau semua lewat dashboard.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- TESTIMONI --}}
<section class="lp-testimonials" id="testimoni">
    <div class="lp-container">
        <div class="lp-section-header">
            <div class="lp-section-badge">Testimoni</div>
            <h2 class="lp-section-title">Apa kata mereka?</h2>
        </div>
        <div class="lp-testi-grid">
            <div class="lp-testi-card">
                <div class="lp-testi-stars">★★★★★</div>
                <p class="lp-testi-text">"KerjainAjaDulu bikin tim kami jauh lebih terorganisir. Tidak ada lagi tugas yang terlewat!"</p>
                <div class="lp-testi-author">
                    <div class="lp-testi-avatar" style="background:#EEF2FF;color:#4F46E5;">AJ</div>
                    <div>
                        <div class="lp-testi-name">Ahmad Jaya</div>
                        <div class="lp-testi-role">Product Manager</div>
                    </div>
                </div>
            </div>
            <div class="lp-testi-card">
                <div class="lp-testi-stars">★★★★★</div>
                <p class="lp-testi-text">"Interface-nya simpel tapi powerful. Tim remote kami akhirnya bisa sinkron dengan baik."</p>
                <div class="lp-testi-author">
                    <div class="lp-testi-avatar" style="background:#FFF7ED;color:#EA580C;">RD</div>
                    <div>
                        <div class="lp-testi-name">Rizky Darmawan</div>
                        <div class="lp-testi-role">Lead Developer</div>
                    </div>
                </div>
            </div>
            <div class="lp-testi-card">
                <div class="lp-testi-stars">★★★★★</div>
                <p class="lp-testi-text">"Gratis dan fiturnya lengkap. Sudah pakai untuk manage tugas kuliah dan project freelance."</p>
                <div class="lp-testi-author">
                    <div class="lp-testi-avatar" style="background:#F0FDF4;color:#16A34A;">SA</div>
                    <div>
                        <div class="lp-testi-name">Siti Aisyah</div>
                        <div class="lp-testi-role">Freelance Designer</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="lp-cta">
    <div class="lp-container lp-cta__inner">
        <h2 class="lp-cta__title">Siap mulai kerjain tugas<br>dengan lebih teratur?</h2>
        <p class="lp-cta__desc">Bergabung dan mulai kelola tugas tim kamu sekarang. Gratis selamanya.</p>
        <a href="{{ route('register') }}" class="lp-btn lp-btn-white lp-btn-lg">Daftar Gratis Sekarang →</a>
        <p style="margin-top:14px;font-size:12px;opacity:.65;">Tidak perlu kartu kredit</p>
    </div>
</section>

{{-- FOOTER --}}
<footer class="lp-footer">
    <div class="lp-container lp-footer__inner">
        <div class="lp-footer__brand">
            <div class="lp-navbar__logo" style="color:#fff;">
                <div class="lp-navbar__logo-icon">K</div>
                <span>KerjainAjaDulu</span>
            </div>
            <p>Kelola tugas tim lebih mudah, lebih teratur, lebih produktif.</p>
        </div>
        <div class="lp-footer__links">
            <div>
                <div class="lp-footer__heading">Produk</div>
                <a href="#fitur">Fitur</a>
                <a href="#cara-kerja">Cara Kerja</a>
                <a href="{{ route('register') }}">Daftar Gratis</a>
            </div>
            <div>
                <div class="lp-footer__heading">Akun</div>
                <a href="{{ route('login') }}">Masuk</a>
                <a href="{{ route('register') }}">Daftar</a>
            </div>
        </div>
    </div>
    <div class="lp-footer__bottom">
        <p>© {{ date('Y') }} KerjainAjaDulu. Dibuat dengan ❤️</p>
    </div>
</footer>

<script>
// Navbar scroll effect
window.addEventListener('scroll', () => {
    document.getElementById('lpNavbar').classList.toggle('scrolled', window.scrollY > 20);
});

// Mobile nav toggle
document.getElementById('lpHamburger').addEventListener('click', function() {
    document.getElementById('lpNav').classList.toggle('open');
    this.classList.toggle('open');
});

// FIX: Reset navbar saat resize ke desktop
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        document.getElementById('lpNav').classList.remove('open');
        document.getElementById('lpHamburger').classList.remove('open');
    }
});

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
            document.getElementById('lpNav').classList.remove('open');
            document.getElementById('lpHamburger').classList.remove('open');
        }
    });
});
</script>
</body>
</html>