@extends('layouts.app')
@section('title', 'Tambah Tugas — KerjainAjaDulu')

@section('content')

<div class="form-page-wrapper">

    <div class="form-page-header">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm">
            ← Kembali
        </a>
        <div style="margin-top: 12px;">
            <h1 class="page-title">Tambah Tugas Baru</h1>
            <p class="page-subtitle">Isi detail tugas yang ingin kamu tambahkan.</p>
        </div>
    </div>

    <div class="card form-card">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Ada kesalahan:</strong>
                    <ul style="margin-top:6px; padding-left:16px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="title">Judul Tugas <span>*</span></label>
                    <input type="text" id="title" name="title" class="form-control"
                           placeholder="Contoh: Buat halaman login"
                           value="{{ old('title') }}" required>
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
                                <option value="{{ $user->id }}" {{ old('assignee_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
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
                           placeholder="Contoh: Frontend, Backend, Design..."
                           value="{{ old('category') }}">
                    <span class="form-hint">Gunakan label untuk mengelompokkan tugas.</span>
                </div>

                <div class="form-actions">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Tugas</button>
                </div>
            </form>

        </div>
    </div>

</div>
@endsection