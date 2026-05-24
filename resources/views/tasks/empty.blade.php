@extends('layouts.app')
@section('title', 'Project Board — KerjainAjaDulu')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Project Board</h1>
        <p class="page-subtitle">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
    <div class="page-header__actions">
        <div class="search-bar">
            <span class="search-bar__icon">
                <i class="ti ti-search"></i>
            </span>
            <input type="text" placeholder="Cari tugas...">
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Tugas
        </a>
    </div>
</div>

{{-- Empty State --}}
<div class="empty-state" style="margin-top: 60px;">
    <div class="empty-state__icon">
        <i class="ti ti-clipboard-list" style="font-size: 64px; color: var(--color-border-dark);"></i>
    </div>
    <div class="empty-state__title" style="margin-top: 16px;">Belum ada tugas</div>
    <div class="empty-state__desc">
        Kamu belum punya tugas apapun. Mulai dengan menambahkan tugas pertama kamu!
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary" style="margin-top: 8px;">
        <i class="ti ti-plus"></i> Tambah Tugas Pertama
    </a>
</div>
@endsection