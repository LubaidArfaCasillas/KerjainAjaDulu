{{-- ============================================================ --}}
{{-- FILE: resources/views/dashboard/index.blade.php             --}}
{{-- ============================================================ --}}
@extends('layouts.app')
@section('title', 'Progress Dashboard — TaskFlow')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Progress Dashboard</h1>
        <p class="page-subtitle">Ringkasan progres tim kamu.</p>
    </div>
</div>

{{-- Stats --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__label">Total Tasks</div>
        <div class="stat-card__value">{{ $totalTasks }}</div>
        <div class="stat-card__change stat-card__change-up">↑ aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Selesai</div>
        <div class="stat-card__value">{{ $doneTasks }}</div>
        <div class="stat-card__change stat-card__change-up">✓ completed</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">In Progress</div>
        <div class="stat-card__value">{{ $inProgressTasks }}</div>
        <div class="stat-card__change" style="color: var(--color-info);">⚡ sedang dikerjakan</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Overdue</div>
        <div class="stat-card__value">{{ $overdueTasks }}</div>
        <div class="stat-card__change stat-card__change-down">⚠ terlambat</div>
    </div>
</div>

{{-- Grid --}}
<div class="dashboard-grid">
    {{-- Task list --}}
    <div class="card">
        <div class="card-header">
            <h3>Task Terbaru</h3>
            <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">Lihat semua →</a>
        </div>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Prioritas</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTasks as $task)
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" style="color: var(--color-primary); font-weight:500;">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td>
                            @php $statusMap = ['todo'=>'badge-todo','in_progress'=>'badge-inprogress','review'=>'badge-review','done'=>'badge-done']; @endphp
                            <span class="badge {{ $statusMap[$task->status] ?? 'badge-gray' }}">{{ $task->status }}</span>
                        </td>
                        <td><span class="badge badge-{{ $task->priority }}">{{ ucfirst($task->priority) }}</span></td>
                        <td style="font-size:0.8125rem; color: var(--color-text-muted);">
                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '—' }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color: var(--color-text-hint); padding: 24px;">Belum ada task.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Team progress --}}
    <div class="card">
        <div class="card-header">
            <h3>Progres Tim</h3>
        </div>
        <div class="card-body">
            @forelse($teamProgress as $member)
            <div class="member-row">
                <div class="avatar avatar-sm avatar-primary">
                    {{ strtoupper(substr($member['name'], 0, 2)) }}
                </div>
                <div class="member-row__info">
                    <div class="member-row__name">{{ $member['name'] }}</div>
                    <div style="margin-top: 6px;">
                        <div class="progress">
                            <div class="progress-bar" style="width: {{ $member['percent'] }}%"></div>
                        </div>
                    </div>
                </div>
                <div class="member-row__tasks">{{ $member['done'] }}/{{ $member['total'] }}</div>
            </div>
            @empty
            <p style="color: var(--color-text-hint); font-size:0.875rem;">Belum ada data.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection