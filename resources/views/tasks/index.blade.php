@extends('layouts.app')
@section('title', 'Project Board — KerjainAjaDulu')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Project Board</h1>
        <p class="page-subtitle">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
    </div>
    <div class="page-header__actions">
        {{-- Hanya tombol tambah tugas, tanpa search bar --}}
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <i class="ti ti-plus"></i> Tambah Tugas
        </a>
    </div>
</div>

{{-- Board kolom --}}
<div class="board-columns">

    {{-- BELUM DIKERJAKAN --}}
    <div class="board-col">
        <div class="board-col__header">
            <span class="board-col__label">
                <span class="board-col__dot board-col__dot-todo"></span>
                Belum Dikerjakan
            </span>
            <span class="board-col__count">{{ $todoTasks->count() }}</span>
        </div>
        @forelse($todoTasks as $task)
            <div class="task-card">
                <a href="{{ route('tasks.show', $task) }}" class="task-card__title">
                    {{ $task->title }}
                </a>
                <div class="task-card__meta">
                    <div class="task-card__tags">
                        <span class="badge badge-{{ strtolower($task->priority) }}">
                            {{ $task->priority == 'high' ? 'Tinggi' : ($task->priority == 'medium' ? 'Sedang' : 'Rendah') }}
                        </span>
                        @if($task->category)
                            <span class="badge badge-gray">{{ $task->category }}</span>
                        @endif
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        @if($task->due_date)
                            <span class="task-card__due">
                                <i class="ti ti-calendar"></i>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M') }}
                            </span>
                        @endif
                        @if($task->assignee)
                            <div class="task-card__assignee">
                                {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding:24px 12px;">
                <div class="empty-state__icon"><i class="ti ti-clipboard"></i></div>
                <p class="empty-state__desc">Belum ada tugas.</p>
            </div>
        @endforelse
    </div>

    {{-- SEDANG DIKERJAKAN --}}
    <div class="board-col">
        <div class="board-col__header">
            <span class="board-col__label">
                <span class="board-col__dot board-col__dot-inprogress"></span>
                Sedang Dikerjakan
            </span>
            <span class="board-col__count">{{ $inProgressTasks->count() }}</span>
        </div>
        @forelse($inProgressTasks as $task)
            <div class="task-card">
                <a href="{{ route('tasks.show', $task) }}" class="task-card__title">
                    {{ $task->title }}
                </a>
                <div class="task-card__meta">
                    <div class="task-card__tags">
                        <span class="badge badge-{{ strtolower($task->priority) }}">
                            {{ $task->priority == 'high' ? 'Tinggi' : ($task->priority == 'medium' ? 'Sedang' : 'Rendah') }}
                        </span>
                        @if($task->category)
                            <span class="badge badge-gray">{{ $task->category }}</span>
                        @endif
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;">
                        @if($task->due_date)
                            <span class="task-card__due">
                                <i class="ti ti-calendar"></i>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('d M') }}
                            </span>
                        @endif
                        @if($task->assignee)
                            <div class="task-card__assignee">
                                {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding:24px 12px;">
                <div class="empty-state__icon"><i class="ti ti-bolt"></i></div>
                <p class="empty-state__desc">Tidak ada yang sedang dikerjakan.</p>
            </div>
        @endforelse
    </div>

    {{-- DIREVIEW --}}
    <div class="board-col">
        <div class="board-col__header">
            <span class="board-col__label">
                <span class="board-col__dot board-col__dot-review"></span>
                Direview
            </span>
            <span class="board-col__count">{{ $reviewTasks->count() }}</span>
        </div>
        @forelse($reviewTasks as $task)
            <div class="task-card">
                <a href="{{ route('tasks.show', $task) }}" class="task-card__title">
                    {{ $task->title }}
                </a>
                <div class="task-card__meta">
                    <div class="task-card__tags">
                        <span class="badge badge-{{ strtolower($task->priority) }}">
                            {{ $task->priority == 'high' ? 'Tinggi' : ($task->priority == 'medium' ? 'Sedang' : 'Rendah') }}
                        </span>
                    </div>
                    @if($task->assignee)
                        <div class="task-card__assignee">
                            {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding:24px 12px;">
                <div class="empty-state__icon"><i class="ti ti-eye"></i></div>
                <p class="empty-state__desc">Tidak ada tugas direview.</p>
            </div>
        @endforelse
    </div>

    {{-- SELESAI --}}
    <div class="board-col">
        <div class="board-col__header">
            <span class="board-col__label">
                <span class="board-col__dot board-col__dot-done"></span>
                Selesai
            </span>
            <span class="board-col__count">{{ $doneTasks->count() }}</span>
        </div>
        @forelse($doneTasks as $task)
            <div class="task-card" style="opacity:0.75;">
                <a href="{{ route('tasks.show', $task) }}" class="task-card__title"
                   style="text-decoration:line-through;color:var(--color-text-muted);">
                    {{ $task->title }}
                </a>
                <div class="task-card__meta">
                    <span class="badge badge-done">Selesai</span>
                    @if($task->assignee)
                        <div class="task-card__assignee">
                            {{ strtoupper(substr($task->assignee->name, 0, 2)) }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state" style="padding:24px 12px;">
                <div class="empty-state__icon"><i class="ti ti-circle-check"></i></div>
                <p class="empty-state__desc">Belum ada tugas selesai.</p>
            </div>
        @endforelse
    </div>

</div>

{{-- Floating Action Button untuk mobile --}}
<a href="{{ route('tasks.create') }}" class="fab fab-mobile" title="Tambah Tugas">
    <span class="fab-icon">+</span>
</a>

@endsection