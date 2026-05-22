@extends('layouts.app')
@section('title', 'Notifikasi — TaskFlow')
@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Notifikasi</h1>
        <p class="page-subtitle">{{ $notifications->whereNull('read_at')->count() }} belum dibaca</p>
    </div>
    @if($notifications->whereNotNull('read_at')->count() < $notifications->count())
    <div class="page-header__actions">
        <form action="{{ route('notifications.read-all') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-secondary btn-sm">✓ Tandai semua dibaca</button>
        </form>
    </div>
    @endif
</div>

<div class="card" style="overflow: hidden;">
    @forelse($notifications as $notif)
    <div class="notif-item {{ is_null($notif->read_at) ? 'unread' : '' }}">
        <div class="notif-item__dot" style="{{ $notif->read_at ? 'opacity:0' : '' }}"></div>
        <div class="notif-item__body">
            <div class="notif-item__text">{{ $notif->data['message'] ?? 'Notifikasi baru' }}</div>
            <div class="notif-item__time">{{ $notif->created_at->diffForHumans() }}</div>
        </div>
    </div>
    @empty
    <div class="empty-state">
        <div class="empty-state__icon">🔔</div>
        <div class="empty-state__title">Tidak ada notifikasi</div>
        <div class="empty-state__desc">Kamu sudah membaca semua notifikasi.</div>
    </div>
    @endforelse
</div>
@endsection