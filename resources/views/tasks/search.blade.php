@extends('layouts.app')
@section('title', 'Search & Filter — TaskFlow')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Search & Filter</h1>
        <p class="page-subtitle">Cari task berdasarkan kata kunci, status, atau prioritas.</p>
    </div>
</div>

{{-- Filter form --}}
<div class="card" style="margin-bottom: 20px;">
    <div class="card-body">
        <form action="{{ route('tasks.search') }}" method="GET">
            <div style="display:flex; gap:14px; align-items:flex-end; flex-wrap:wrap;">

                <div class="form-group" style="margin-bottom:0; flex:1; min-width:180px;">
                    <label class="form-label">Kata kunci</label>
                    <div class="search-bar" style="width:100%;">
                        <span class="search-bar__icon">🔍</span>
                        <input type="text" name="q" style="width:100%;"
                               placeholder="Cari judul, deskripsi, kategori..."
                               value="{{ request('q') }}">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom:0; width:160px;">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua status</option>
                        <option value="todo"        {{ request('status') == 'todo'        ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="review"      {{ request('status') == 'review'      ? 'selected' : '' }}>Review</option>
                        <option value="done"        {{ request('status') == 'done'        ? 'selected' : '' }}>Done</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom:0; width:160px;">
                    <label class="form-label">Prioritas</label>
                    <select name="priority" class="form-control">
                        <option value="">Semua prioritas</option>
                        <option value="high"   {{ request('priority') == 'high'   ? 'selected' : '' }}>🔴 High</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                        <option value="low"    {{ request('priority') == 'low'    ? 'selected' : '' }}>🟢 Low</option>
                    </select>
                </div>

                <div style="display:flex; gap:8px; flex-shrink:0; padding-bottom:1px;">
                    <button type="submit" class="btn btn-primary">Cari</button>
                    <a href="{{ route('tasks.search') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Results --}}
@if(request()->hasAny(['q','status','priority']))
    <p style="font-size:0.875rem; color: var(--color-text-muted); margin-bottom:12px;">
        Ditemukan <strong>{{ $tasks->total() }}</strong> task
    </p>

    @if($tasks->count())
    <div class="card" style="overflow:hidden;">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Prioritas</th>
                        <th>Deadline</th>
                        <th>Assignee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    @php
                        $statusMap   = ['todo'=>'badge-todo','in_progress'=>'badge-inprogress','review'=>'badge-review','done'=>'badge-done'];
                        $statusLabel = ['todo'=>'To Do','in_progress'=>'In Progress','review'=>'Review','done'=>'Done'];
                    @endphp
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}"
                               style="font-weight:600; color: var(--color-primary);">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td>
                            @if($task->category)
                                <span class="badge badge-gray">{{ $task->category }}</span>
                            @else
                                <span style="color: var(--color-text-hint);">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $statusMap[$task->status] ?? 'badge-gray' }}">
                                {{ $statusLabel[$task->status] ?? $task->status }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span>
                        </td>
                        <td style="font-size:0.8125rem; color: var(--color-text-muted);">
                            @if($task->due_date)
                                @php $due = \Carbon\Carbon::parse($task->due_date); @endphp
                                <span style="{{ $due->isPast() && $task->status !== 'done' ? 'color:var(--color-danger);font-weight:600;' : '' }}">
                                    {{ $due->format('d M Y') }}
                                </span>
                            @else
                                —
                            @endif
                        </td>
                        <td>
                            @if($task->assignee)
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <div class="avatar avatar-sm avatar-primary">
                                        {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                                    </div>
                                    <span style="font-size:0.8125rem;">{{ $task->assignee->name }}</span>
                                </div>
                            @else
                                <span style="color: var(--color-text-hint); font-size:0.8125rem;">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top:16px;">
        {{ $tasks->links() }}
    </div>

    @else
    <div class="empty-state">
        <div class="empty-state__icon">🔍</div>
        <div class="empty-state__title">Tidak ada hasil</div>
        <div class="empty-state__desc">Coba ubah kata kunci atau filter yang kamu gunakan.</div>
        <a href="{{ route('tasks.search') }}" class="btn btn-secondary">Reset filter</a>
    </div>
    @endif

@else
    <div class="empty-state">
        <div class="empty-state__icon">🔎</div>
        <div class="empty-state__title">Masukkan kata kunci untuk mulai pencarian</div>
        <div class="empty-state__desc">Kamu bisa filter berdasarkan judul, status, atau prioritas task.</div>
    </div>
@endif

@endsection