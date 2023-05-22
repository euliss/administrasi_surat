@extends('layouts.dashboard')

@section('container')
    <div class="container mb-5">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/agenda">Agenda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/agenda">
                        < Kembali ke halaman Agenda</a>
                </div>
            </div>
            <h3 class="my-4">{{ $title }}</h3>
            <form action="/tasks/{{ $tk->id }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                <div class="mb-3">
                    <label for="name" class="form-label"><i class="bi bi-calendar-minus"></i> Nama Kegiatan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        required value="{{ old('name', $tk->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label"><i class="bi bi-mailbox2"></i> Target</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
                        name="description" required value="{{ old('description', $tk->description) }}">
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="task_date" class="form-label"><i class="bi bi-calendar"></i> Tanggal</label>
                    <input type="date" class="form-control @error('task_date') is-invalid @enderror" id="task_date"
                        name="task_date" required value="{{ old('task_date', $tk->task_date) }}">
                    @error('task_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-info d-inline">Save</button>
            </form>
        </div>
    </div>
    </div>
@endsection
