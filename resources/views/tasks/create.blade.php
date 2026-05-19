@extends('layouts.app')
@section('title', 'Tambah Task — TaskFlow')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <a href="{{ route('tasks.index') }}" class="btn btn-ghost btn-sm" style="margin-bottom:8px;">
            ← Kembali
        </a>
        <h1 class="page-title">Tambah Task Baru</h1>
        <p class="page-subtitle">Isi detail task yang ingin kamu tambahkan.</p>
    </div>
</div>

<div style="max-width: 720px;">
    <div class="card">
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
                    <label class="form-label" for="title">Judul Task <span>*</span></label>
                    <input type="text" id="title" name="title" class="form-control"
                           placeholder="Contoh: Buat halaman login" value="{{ old('title') }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control"
                              placeholder="Jelaskan detail task ini..." rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="status">Status <span>*</span></label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="">Pilih status...</option>
                            <option value="todo"        {{ old('status', request('status')) == 'todo'        ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status', request('status')) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="review"      {{ old('status', request('status')) == 'review'      ? 'selected' : '' }}>Review</option>
                            <option value="done"        {{ old('status', request('status')) == 'done'        ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="priority">Prioritas <span>*</span></label>
                        <select id="priority" name="priority" class="form-control" required>
                            <option value="">Pilih prioritas...</option>
                            <option value="high"   {{ old('priority') == 'high'   ? 'selected' : '' }}>🔴 High</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="low"    {{ old('priority') == 'low'    ? 'selected' : '' }}>🟢 Low</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="assignee_id">Assignee</label>
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
                    <span class="form-hint">Gunakan label untuk mengelompokkan task.</span>
                </div>

                <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:8px;">
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Task</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection