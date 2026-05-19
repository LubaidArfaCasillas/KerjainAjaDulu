@extends('layouts.app')
@section('title', 'Edit Task — TaskFlow')

@section('content')
<div class="page-header">
    <div class="page-header__left">
        <a href="{{ route('tasks.show', $task) }}" class="btn btn-ghost btn-sm" style="margin-bottom:8px;">← Kembali</a>
        <h1 class="page-title">Edit Task</h1>
    </div>
</div>

<div style="max-width: 720px;">
    <div class="card">
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf @method('PUT')

                <div class="form-group">
                    <label class="form-label" for="title">Judul Task <span>*</span></label>
                    <input type="text" id="title" name="title" class="form-control"
                           value="{{ old('title', $task->title) }}" required>
                    @error('title')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $task->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="status">Status <span>*</span></label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="todo"        {{ old('status', $task->status) == 'todo'        ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="review"      {{ old('status', $task->status) == 'review'      ? 'selected' : '' }}>Review</option>
                            <option value="done"        {{ old('status', $task->status) == 'done'        ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="priority">Prioritas <span>*</span></label>
                        <select id="priority" name="priority" class="form-control" required>
                            <option value="high"   {{ old('priority', $task->priority) == 'high'   ? 'selected' : '' }}>🔴 High</option>
                            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="low"    {{ old('priority', $task->priority) == 'low'    ? 'selected' : '' }}>🟢 Low</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="assignee_id">Assignee</label>
                        <select id="assignee_id" name="assignee_id" class="form-control">
                            <option value="">Pilih anggota...</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('assignee_id', $task->assignee_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="due_date">Deadline</label>
                        <input type="date" id="due_date" name="due_date" class="form-control"
                               value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="category">Kategori</label>
                    <input type="text" id="category" name="category" class="form-control"
                           value="{{ old('category', $task->category) }}" placeholder="Frontend, Backend, Design...">
                </div>

                <div style="display:flex; gap:12px; justify-content:flex-end; margin-top:8px;">
                    <a href="{{ route('tasks.show', $task) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection