@extends('layouts.app')
@section('title', $task->title . ' — KerjainAjaDulu')

@section('content')

<div class="form-page-wrapper" style="max-width: 900px;">

    <div class="form-page-header">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">
            ← Kembali ke Board
        </a>
    </div>

    <div class="task-detail-layout" style="margin-top: 20px;">

        {{-- MAIN --}}
        <div class="task-detail-main">

            <h1 class="task-detail-title">{{ $task->title }}</h1>

            <div class="task-detail-meta">
                @php
                    $statusMap  = ['todo'=>'badge-todo','in_progress'=>'badge-inprogress','review'=>'badge-review','done'=>'badge-done'];
                    $statusLabel = ['todo'=>'Belum Dikerjakan','in_progress'=>'Sedang Dikerjakan','review'=>'Direview','done'=>'Selesai'];
                @endphp
                <span class="badge {{ $statusMap[$task->status] ?? 'badge-gray' }}">
                    {{ $statusLabel[$task->status] ?? $task->status }}
                </span>
                <span class="badge badge-{{ strtolower($task->priority) }}">
                    {{ $task->priority == 'high' ? 'Tinggi' : ($task->priority == 'medium' ? 'Sedang' : 'Rendah') }}
                </span>
                @if($task->category)
                    <span class="badge badge-gray">{{ $task->category }}</span>
                @endif
            </div>

            {{-- Deskripsi --}}
            <div class="task-detail-section">
                <div class="task-detail-section-label">Deskripsi</div>
                <div class="task-detail-body">
                    {!! nl2br(e($task->description ?? 'Tidak ada deskripsi.')) !!}
                </div>
            </div>

            {{-- Update Status --}}
            <div class="task-detail-section">
                <div class="task-detail-section-label">Update Status</div>
                <form action="{{ route('tasks.update', $task) }}" method="POST"
                      style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                    @csrf @method('PUT')
                    <select name="status" class="form-control" style="width:220px; max-width:100%;">
                        <option value="todo"        {{ $task->status == 'todo'        ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="in_progress" {{ $task->status == 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="review"      {{ $task->status == 'review'      ? 'selected' : '' }}>Direview</option>
                        <option value="done"        {{ $task->status == 'done'        ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                </form>
            </div>

            {{-- Komentar --}}
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

                <form action="{{ route('tasks.comments.store', $task) }}" method="POST"
                      style="margin-top: 16px;">
                    @csrf
                    <div class="form-group" style="margin-bottom: 10px;">
                        <textarea name="body" class="form-control" rows="3"
                                  placeholder="Tulis komentar..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Kirim Komentar</button>
                </form>
            </div>

        </div>

        {{-- SIDEBAR INFO --}}
        <div class="task-detail-sidebar">

            <div class="task-info-card">
                <div class="task-info-row">
                    <span class="task-info-label">Dikerjakan oleh</span>
                    <div style="display:flex; align-items:center; gap:8px;" class="task-info-value">
                        @if($task->assignee)
                            <div class="avatar avatar-sm avatar-primary">
                                {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                            </div>
                            {{ $task->assignee->name }}
                        @else
                            <span style="color: var(--color-text-hint); font-weight:400;">Belum diassign</span>
                        @endif
                    </div>
                </div>

                <div class="task-info-row">
                    <span class="task-info-label">Deadline</span>
                    <span class="task-info-value">
                        @if($task->due_date)
                            @php $due = \Carbon\Carbon::parse($task->due_date); @endphp
                            <span style="color: {{ $due->isPast() && $task->status !== 'done' ? 'var(--color-danger)' : 'var(--color-text)' }}">
                                {{ $due->format('d M Y') }}
                            </span>
                        @else
                            <span style="color: var(--color-text-hint); font-weight:400;">—</span>
                        @endif
                    </span>
                </div>

                <div class="task-info-row">
                    <span class="task-info-label">Dibuat oleh</span>
                    <span class="task-info-value">{{ $task->creator->name ?? '—' }}</span>
                </div>

                <div class="task-info-row">
                    <span class="task-info-label">Tanggal dibuat</span>
                    <span class="task-info-value">{{ $task->created_at->format('d M Y') }}</span>
                </div>

                <div class="task-info-row">
                    <span class="task-info-label">Diupdate</span>
                    <span class="task-info-value">{{ $task->updated_at->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Aksi --}}
            <div style="display:flex; flex-direction:column; gap:8px; margin-top:14px;">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary w-100">
                    ✏️ Edit Tugas
                </a>
                <form action="{{ route('tasks.archive-task', $task) }}" method="POST">
                    @csrf @method('PUT')
                    <button type="submit" class="btn btn-ghost w-100">🗄️ Arsipkan</button>
                </form>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus tugas ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger w-100">🗑️ Hapus Tugas</button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection