@extends('layouts.app')
@section('title', $task->title . ' — TaskFlow')

@section('content')
<div style="margin-bottom: 20px;">
    <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">← Kembali ke Board</a>
</div>

<div class="task-detail-layout">

    {{-- MAIN --}}
    <div class="task-detail-main">

        <div class="task-detail-header">
            <h1 class="task-detail-title">{{ $task->title }}</h1>
            <div class="task-detail-meta">
                @php
                    $statusMap = [
                        'todo'        => 'badge-todo',
                        'in_progress' => 'badge-inprogress',
                        'review'      => 'badge-review',
                        'done'        => 'badge-done',
                    ];
                    $statusLabel = [
                        'todo'        => 'To Do',
                        'in_progress' => 'In Progress',
                        'review'      => 'Review',
                        'done'        => 'Done',
                    ];
                @endphp
                <span class="badge {{ $statusMap[$task->status] ?? 'badge-gray' }}">
                    {{ $statusLabel[$task->status] ?? $task->status }}
                </span>
                <span class="badge badge-{{ strtolower($task->priority) }}">
                    {{ ucfirst($task->priority) }}
                </span>
                @if($task->category)
                    <span class="badge badge-gray">{{ $task->category }}</span>
                @endif
            </div>
        </div>

        {{-- Description --}}
        <div class="task-detail-section">
            <div class="task-detail-section-label">Deskripsi</div>
            <div class="task-detail-body">
                {!! nl2br(e($task->description ?? 'Tidak ada deskripsi.')) !!}
            </div>
        </div>

        {{-- Update Status --}}
        <div class="task-detail-section">
            <div class="task-detail-section-label">Update Status</div>
            <form action="{{ route('tasks.update', $task) }}" method="POST" style="display:flex; gap:10px; align-items:center;">
                @csrf
                @method('PUT')
                <select name="status" class="form-control" style="width:200px;">
                    <option value="todo"        {{ $task->status == 'todo'        ? 'selected' : '' }}>To Do</option>
                    <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review"      {{ $task->status == 'review'      ? 'selected' : '' }}>Review</option>
                    <option value="done"        {{ $task->status == 'done'        ? 'selected' : '' }}>Done</option>
                </select>
                <button type="submit" class="btn btn-primary btn-sm">Update</button>
            </form>
        </div>

        {{-- Comments --}}
        <div class="task-detail-section">
            <div class="task-detail-section-label">Komentar ({{ $task->comments->count() }})</div>

            @forelse($task->comments as $comment)
                <div class="comment-item">
                    <div class="avatar avatar-sm avatar-primary">
                        {{ strtoupper(substr($comment->user->name, 0, 2)) }}
                    </div>
                    <div class="comment-body">
                        <div class="comment-author">
                            {{ $comment->user->name }}
                            <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="comment-text">{{ $comment->body }}</div>
                    </div>
                </div>
            @empty
                <p style="color: var(--color-text-hint); font-size: 0.875rem; padding: 12px 0;">
                    Belum ada komentar.
                </p>
            @endforelse

            {{-- Add comment --}}
            <form action="{{ route('tasks.comments.store', $task) }}" method="POST" style="margin-top: 16px;">
                @csrf
                <div class="form-group" style="margin-bottom: 10px;">
                    <textarea name="body" class="form-control" rows="3"
                              placeholder="Tulis komentar..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
            </form>
        </div>

    </div>

    {{-- SIDEBAR --}}
    <div class="task-detail-sidebar">

        {{-- Info card --}}
        <div class="task-info-card">
            <div class="task-info-row">
                <span class="task-info-label">Assignee</span>
                <div style="display:flex; align-items:center; gap:8px;" class="task-info-value">
                    @if($task->assignee)
                        <div class="avatar avatar-sm avatar-primary">
                            {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                        </div>
                        {{ $task->assignee->name }}
                    @else
                        <span style="color: var(--color-text-hint); font-weight: 400;">Belum diassign</span>
                    @endif
                </div>
            </div>

            <div class="task-info-row">
                <span class="task-info-label">Deadline</span>
                <span class="task-info-value">
                    @if($task->due_date)
                        @php $due = \Carbon\Carbon::parse($task->due_date); @endphp
                        <span style="color: {{ $due->isPast() ? 'var(--color-danger)' : 'var(--color-text)' }}">
                            {{ $due->format('d M Y') }}
                        </span>
                    @else
                        <span style="color: var(--color-text-hint); font-weight: 400;">—</span>
                    @endif
                </span>
            </div>

            <div class="task-info-row">
                <span class="task-info-label">Dibuat oleh</span>
                <span class="task-info-value">{{ $task->creator->name ?? '—' }}</span>
            </div>

            <div class="task-info-row">
                <span class="task-info-label">Dibuat pada</span>
                <span class="task-info-value">{{ $task->created_at->format('d M Y') }}</span>
            </div>

            <div class="task-info-row">
                <span class="task-info-label">Diupdate</span>
                <span class="task-info-value">{{ $task->updated_at->diffForHumans() }}</span>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display:flex; flex-direction:column; gap:8px;">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary w-100">
                ✏️ Edit Task
            </a>
            <form action="{{ route('tasks.archive-task', $task) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="btn btn-ghost w-100">🗄️ Arsipkan</button>
            </form>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                  onsubmit="return confirm('Yakin hapus task ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger w-100">🗑️ Hapus Task</button>
            </form>
        </div>

    </div>
</div>
@endsection