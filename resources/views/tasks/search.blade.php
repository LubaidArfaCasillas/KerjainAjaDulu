@extends('layouts.app')
@section('title', 'Cari & Filter — KerjainAjaDulu')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Cari & Filter</h1>
        <p class="page-subtitle">Temukan tugas berdasarkan kata kunci, status, atau prioritas.</p>
    </div>
</div>

<div class="card" style="margin-bottom:18px;">
    <div class="card-body">
        <form action="{{ route('tasks.search') }}" method="GET">
            <div style="display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
                <div class="form-group" style="margin-bottom:0;flex:1;min-width:180px;">
                    <label class="form-label">Kata kunci</label>
                    <div class="search-bar" style="width:100%;">
                        <i class="ti ti-search"></i>
                        <input type="text" name="q" style="width:100%;" placeholder="Cari judul, deskripsi..." value="{{ request('q') }}">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom:0;width:160px;">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="">Semua status</option>
                        <option value="todo"        {{ request('status')=='todo'        ? 'selected':'' }}>Belum Dikerjakan</option>
                        <option value="in_progress" {{ request('status')=='in_progress' ? 'selected':'' }}>Sedang Dikerjakan</option>
                        <option value="review"      {{ request('status')=='review'      ? 'selected':'' }}>Direview</option>
                        <option value="done"        {{ request('status')=='done'        ? 'selected':'' }}>Selesai</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom:0;width:150px;">
                    <label class="form-label">Prioritas</label>
                    <select name="priority" class="form-control">
                        <option value="">Semua</option>
                        <option value="high"   {{ request('priority')=='high'   ? 'selected':'' }}>🔴 Tinggi</option>
                        <option value="medium" {{ request('priority')=='medium' ? 'selected':'' }}>🟡 Sedang</option>
                        <option value="low"    {{ request('priority')=='low'    ? 'selected':'' }}>🟢 Rendah</option>
                    </select>
                </div>
                <div style="display:flex;gap:8px;padding-bottom:1px;">
                    <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i> Cari</button>
                    <a href="{{ route('tasks.search') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

@if(request()->hasAny(['q','status','priority']))
    <p style="font-size:13px;color:var(--text-muted);margin-bottom:12px;">
        Ditemukan <strong>{{ $tasks->total() }}</strong> tugas
    </p>

    @if($tasks->count())
        <div class="card" style="overflow:hidden;">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Prioritas</th>
                            <th>Deadline</th>
                            <th>Dikerjakan oleh</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        @php
                            $sMap   = ['todo'=>'badge-todo','in_progress'=>'badge-inprogress','review'=>'badge-review','done'=>'badge-done'];
                            $sLabel = ['todo'=>'Belum','in_progress'=>'Dikerjakan','review'=>'Direview','done'=>'Selesai'];
                        @endphp
                        <tr>
                            <td>
                                <a href="{{ route('tasks.show', $task) }}" style="color:var(--primary);font-weight:600;">{{ $task->title }}</a>
                                @if($task->category)<span class="badge badge-gray" style="margin-left:6px;">{{ $task->category }}</span>@endif
                            </td>
                            <td><span class="badge {{ $sMap[$task->status] ?? 'badge-gray' }}">{{ $sLabel[$task->status] ?? $task->status }}</span></td>
                            <td>
                                <span class="badge badge-{{ $task->priority }}">
                                    {{ $task->priority=='high' ? 'Tinggi' : ($task->priority=='medium' ? 'Sedang' : 'Rendah') }}
                                </span>
                            </td>
                            <td style="font-size:12px;color:var(--text-muted);">
                                @if($task->due_date)
                                    @php $due = \Carbon\Carbon::parse($task->due_date); @endphp
                                    <span style="{{ $due->isPast() && $task->status!='done' ? 'color:var(--danger);font-weight:600;' : '' }}">
                                        {{ $due->format('d M Y') }}
                                    </span>
                                @else —
                                @endif
                            </td>
                            <td>
                                @if($task->assignee)
                                    <div style="display:flex;align-items:center;gap:7px;">
                                        <div class="avatar avatar-sm avatar-primary">{{ strtoupper(substr($task->assignee->name,0,2)) }}</div>
                                        <span style="font-size:12px;">{{ $task->assignee->name }}</span>
                                    </div>
                                @else
                                    <span style="color:var(--text-hint);font-size:12px;">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div style="margin-top:14px;">{{ $tasks->links() }}</div>
    @else
        <div class="empty-state">
            <div class="empty-state__icon"><i class="ti ti-search" style="font-size:2.5rem;"></i></div>
            <div class="empty-state__title">Tidak ada hasil</div>
            <div class="empty-state__desc">Coba ubah kata kunci atau filter yang kamu gunakan.</div>
            <a href="{{ route('tasks.search') }}" class="btn btn-secondary">Reset filter</a>
        </div>
    @endif
@else
    <div class="empty-state">
        <div class="empty-state__icon"><i class="ti ti-search" style="font-size:2.5rem;"></i></div>
        <div class="empty-state__title">Masukkan kata kunci untuk mencari</div>
        <div class="empty-state__desc">Kamu bisa filter berdasarkan judul, status, atau prioritas tugas.</div>
    </div>
@endif
@endsection