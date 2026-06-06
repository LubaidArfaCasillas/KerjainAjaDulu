{{-- FILE: resources/views/tasks/archive.blade.php --}}
@extends('layouts.app')
@section('title', 'Arsip — KerjainAjaDulu')
@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Arsip</h1>
        <p class="page-subtitle">{{ $tasks->count() }} tugas diarsipkan</p>
    </div>
</div>

<div class="archive-filters">
    <button class="filter-chip active" onclick="filterArchive('all',this)">Semua</button>
    <button class="filter-chip" onclick="filterArchive('high',this)">🔴 Tinggi</button>
    <button class="filter-chip" onclick="filterArchive('medium',this)">🟡 Sedang</button>
    <button class="filter-chip" onclick="filterArchive('low',this)">🟢 Rendah</button>
</div>

@if($tasks->count())
<div class="card" style="overflow:hidden;">
    @foreach($tasks as $task)
    <div class="task-archive-row" data-priority="{{ $task->priority }}"
         style="display:flex;align-items:center;gap:14px;padding:13px 20px;border-bottom:1px solid var(--border);">
        <div style="flex:1;min-width:0;">
            <div style="font-size:13px;font-weight:600;color:var(--text-muted);text-decoration:line-through;margin-bottom:3px;">{{ $task->title }}</div>
            <div style="font-size:11px;color:var(--text-hint);">Diarsipkan {{ $task->updated_at->diffForHumans() }}</div>
        </div>
        <span class="badge badge-{{ $task->priority }}">{{ $task->priority=='high' ? 'Tinggi' : ($task->priority=='medium' ? 'Sedang' : 'Rendah') }}</span>
        <div style="display:flex;gap:8px;">
            <form action="{{ route('tasks.restore', $task) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-secondary btn-sm"><i class="ti ti-restore"></i> Restore</button>
            </form>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Hapus permanen?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="empty-state" style="padding:60px 20px;">
    <div class="empty-state__icon"><i class="ti ti-archive" style="font-size:2.5rem;"></i></div>
    <div class="empty-state__title">Arsip kosong</div>
    <div class="empty-state__desc">Tugas yang kamu arsipkan akan muncul di sini.</div>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary"><i class="ti ti-layout-kanban"></i> Ke Project Board</a>
</div>
@endif

@push('scripts')
<script>
function filterArchive(p, btn) {
    document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.task-archive-row').forEach(row => {
        row.style.display = (p==='all' || row.dataset.priority===p) ? 'flex' : 'none';
    });
}
</script>
@endpush
@endsection