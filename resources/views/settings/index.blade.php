@extends('layouts.app')
@section('title', 'Settings — TaskFlow')
@section('content')
<div class="page-header">
    <div class="page-header__left">
        <h1 class="page-title">Settings</h1>
    </div>
</div>

<div class="settings-layout">
    <nav class="settings-nav">
        <a href="#notifikasi" class="active">Notifikasi</a>
        <a href="#privasi">Privasi</a>
        <a href="#tampilan">Tampilan</a>
    </nav>

    <div class="settings-main">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf @method('PUT')

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="settings-section" id="notifikasi">
                        <div class="settings-section-title">Notifikasi Email</div>

                        <div class="settings-row">
                            <div>
                                <div class="settings-row__label">Task baru diassign</div>
                                <div class="settings-row__desc">Dapat email saat ada task baru untuk kamu</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" name="notif_assigned" value="1"
                                    {{ ($settings['notif_assigned'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="settings-row">
                            <div>
                                <div class="settings-row__label">Komentar baru</div>
                                <div class="settings-row__desc">Dapat email saat ada komentar di task kamu</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" name="notif_comment" value="1"
                                    {{ ($settings['notif_comment'] ?? true) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="settings-row">
                            <div>
                                <div class="settings-row__label">Deadline reminder</div>
                                <div class="settings-row__desc">Pengingat H-1 sebelum deadline</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" name="notif_deadline" value="1"
                                    {{ ($settings['notif_deadline'] ?? false) ? 'checked' : '' }}>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="settings-section" id="tampilan">
                        <div class="settings-section-title">Tampilan</div>
                        <div class="settings-row">
                            <div>
                                <div class="settings-row__label">Default view board</div>
                                <div class="settings-row__desc">Tampilan saat pertama buka board</div>
                            </div>
                            <select name="default_view" class="form-control" style="width:140px;">
                                <option value="board" {{ ($settings['default_view'] ?? 'board') == 'board' ? 'selected' : '' }}>Board</option>
                                <option value="list"  {{ ($settings['default_view'] ?? '') == 'list'  ? 'selected' : '' }}>List</option>
                            </select>
                        </div>
                    </div>

                    <div style="display:flex; justify-content:flex-end;">
                        <button type="submit" class="btn btn-primary">Simpan Settings</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection