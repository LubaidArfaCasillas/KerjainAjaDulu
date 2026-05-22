{{-- ============================================================ --}}
{{-- FILE: resources/views/team/index.blade.php                  --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Team Overview — TaskFlow')
@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Team Overview</h1>
        <p class="page-subtitle">{{ $users->count() }} anggota tim</p>
    </div>
</div>
<div class="team-grid">
    @forelse($users as $user)
    <div class="team-card">
        <div class="avatar avatar-lg avatar-primary team-card__avatar">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div class="team-card__name">{{ $user->name }}</div>
        <div class="team-card__role">{{ $user->role ?? 'Member' }}</div>
        <div class="team-card__stats">
            <div>
                <div class="team-card__stat-val">{{ $user->tasks->whereIn('status', ['todo','in_progress','review'])->count() }}</div>
                <div class="team-card__stat-label">Aktif</div>
            </div>
            <div>
                <div class="team-card__stat-val">{{ $user->tasks->where('status','done')->count() }}</div>
                <div class="team-card__stat-label">Selesai</div>
            </div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state__icon">👥</div>
        <div class="empty-state__title">Belum ada anggota tim</div>
    </div>
    @endforelse
</div>
@endsection