@extends('layouts.app')
@section('title', 'Tambah Tugas — KerjainAjaDulu')

@section('content')
<a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:16px;">
    <i class="ti ti-arrow-left"></i> Kembali
</a>

<h1 class="page-title" style="margin-bottom:4px;">Tambah Tugas Baru</h1>
<p class="page-subtitle" style="margin-bottom:22px;">Isi detail tugas yang ingin kamu tambahkan.</p>

<div class="card">
    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="padding-left:16px;margin:0;">
                    @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Judul Tugas <span>*</span></label>
                <input type="text" id="title" name="title" class="form-control"
                       placeholder="Contoh: Buat halaman login" value="{{ old('title') }}" required>
                @error('title')<span class="form-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea id="description" name="description" class="form-control"
                          placeholder="Jelaskan detail tugas ini..." rows="4">{{ old('description') }}</textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="status">Status <span>*</span></label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="">Pilih status...</option>
                        <option value="todo"        {{ old('status', request('status')) == 'todo'        ? 'selected' : '' }}>Belum Dikerjakan</option>
                        <option value="in_progress" {{ old('status', request('status')) == 'in_progress' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                        <option value="review"      {{ old('status', request('status')) == 'review'      ? 'selected' : '' }}>Direview</option>
                        <option value="done"        {{ old('status', request('status')) == 'done'        ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="priority">Prioritas <span>*</span></label>
                    <select id="priority" name="priority" class="form-control" required>
                        <option value="">Pilih prioritas...</option>
                        <option value="high"   {{ old('priority') == 'high'   ? 'selected' : '' }}>🔴 Tinggi</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>🟡 Sedang</option>
                        <option value="low"    {{ old('priority') == 'low'    ? 'selected' : '' }}>🟢 Rendah</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="assignee_id">Dikerjakan oleh</label>
                    <select id="assignee_id" name="assignee_id" class="form-control">
                        <option value="">Pilih anggota...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('assignee_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="due_date">Deadline</label>
                    <input type="date" id="due_date" name="due_date" class="form-control"
                           value="{{ old('due_date') }}" min="{{ now()->format('Y-m-d') }}">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="category">Kategori</label>
                <input type="text" id="category" name="category" class="form-control"
                       placeholder="Contoh: Frontend, Backend, Design..." value="{{ old('category') }}">
                <span class="form-hint">Gunakan label untuk mengelompokkan tugas.</span>
            </div>
            <div class="form-actions">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Tugas</button>
            </div>
        </form>
    </div>
</div>
@endsection