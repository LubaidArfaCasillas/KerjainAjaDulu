@extends('layouts.app')
@section('title', 'Archive — TaskFlow')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Archive / Trash</h1>
        <p class="page-subtitle">{{ $tasks->count() }} task diarsipkan</p>
    </div>
</div>

{{-- Filter chips --}}
<div class="archive-filters">
    <button class="filter-chip active" onclick="filterArchive('all', this)">Semua</button>
    <button class="filter-chip" onclick="filterArchive('high', this)">🔴 High</button>
    <button class="filter-chip" onclick="filterArchive('medium', this)">🟡 Medium</button>
    <button class="filter-chip" onclick="filterArchive('low', this)">🟢 Low</button>
</div>

@if($tasks->count())
<div class="card" style="overflow:hidden;">
    @foreach($tasks as $task)
    <div class="task-archive-row"
         data-priority="{{ $task->priority }}"
         style="display:flex; align-items:center; gap:16px; padding:14px 20px; border-bottom:1px solid var(--color-border);">

        <div style="flex:1; min-width:0;">
            <div style="font-size:0.875rem; font-weight:600; color: var(--color-text-muted);
                        text-decoration:line-through; margin-bottom:4px;">
                {{ $task->title }}
            </div>
            <div style="font-size:0.75rem; color: var(--color-text-hint); display:flex; gap:12px;">
                <span>Diarsipkan {{ $task->updated_at->diffForHumans() }}</span>
                @if($task->category)
                    <span>📁 {{ $task->category }}</span>
                @endif
            </div>
        </div>

        <span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span>

        <div style="display:flex; gap:8px; flex-shrink:0;">
            <form action="{{ route('tasks.restore', $task) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-secondary btn-sm">↩ Restore</button>
            </form>

            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                  onsubmit="return confirm('Hapus task ini secara permanen? Tidak bisa dibatalkan.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑️ Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@else
<div class="empty-state">
    <div class="empty-state__icon">🗄️</div>
    <div class="empty-state__title">Archive kosong</div>
    <div class="empty-state__desc">Task yang kamu arsipkan akan muncul di sini.</div>
    <a href="{{ route('tasks.index') }}" class="btn btn-primary">Ke Project Board</a>
</div>
@endif

@push('scripts')
<script>
function filterArchive(priority, btn) {
    document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
    btn.classList.add('active');
    document.querySelectorAll('.task-archive-row').forEach(row => {
        row.style.display = (priority === 'all' || row.dataset.priority === priority)
            ? 'flex' : 'none';
    });
}
</script>
@endpush

@endsection