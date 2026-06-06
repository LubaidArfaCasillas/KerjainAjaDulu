@extends('layouts.app')
@section('title', 'Progress — KerjainAjaDulu')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Progress Dashboard</h1>
        <p class="page-subtitle">Ringkasan progres tim kamu</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__label">Total Tugas</div>
        <div class="stat-card__value">{{ $totalTasks }}</div>
        <div class="stat-card__change stat-card__change-up">aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Selesai</div>
        <div class="stat-card__value">{{ $doneTasks }}</div>
        <div class="stat-card__change stat-card__change-up">✓ completed</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Sedang Dikerjakan</div>
        <div class="stat-card__value">{{ $inProgressTasks }}</div>
        <div class="stat-card__change" style="color:var(--primary);">⚡ in progress</div>
    </div>
    <div class="stat-card">
        <div class="stat-card__label">Terlambat</div>
        <div class="stat-card__value">{{ $overdueTasks }}</div>
        <div class="stat-card__change stat-card__change-down">⚠ overdue</div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card">
        <div class="card-header">
            <h3>Tugas Terbaru</h3>
            <a href="{{ route('tasks.index') }}" style="font-size:12px;color:var(--primary);">Lihat semua →</a>
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
                    @php
                        $sMap   = ['todo'=>'badge-todo','in_progress'=>'badge-inprogress','review'=>'badge-review','done'=>'badge-done'];
                        $sLabel = ['todo'=>'Belum','in_progress'=>'Dikerjakan','review'=>'Direview','done'=>'Selesai'];
                    @endphp
                    <tr>
                        <td><a href="{{ route('tasks.show', $task) }}" style="color:var(--primary);font-weight:600;">{{ $task->title }}</a></td>
                        <td><span class="badge {{ $sMap[$task->status] ?? 'badge-gray' }}">{{ $sLabel[$task->status] ?? $task->status }}</span></td>
                        <td><span class="badge badge-{{ $task->priority }}">{{ $task->priority=='high'?'Tinggi':($task->priority=='medium'?'Sedang':'Rendah') }}</span></td>
                        <td style="font-size:12px;color:var(--text-muted);">{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('d M Y') : '—' }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;color:var(--text-hint);padding:24px;">Belum ada tugas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>Progres Tim</h3></div>
        <div class="card-body">
            @forelse($teamProgress as $member)
            <div class="member-row">
                <div class="avatar avatar-sm avatar-primary">{{ strtoupper(substr($member['name'],0,2)) }}</div>
                <div class="member-row__info">
                    <div class="member-row__name">{{ $member['name'] }}</div>
                    <div class="progress" style="margin-top:5px;">
                        <div class="progress-bar" style="width:{{ $member['percent'] }}%"></div>
                    </div>
                </div>
                <div class="member-row__tasks">{{ $member['done'] }}/{{ $member['total'] }}</div>
            </div>
            @empty
            <p style="color:var(--text-hint);font-size:13px;">Belum ada data.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection