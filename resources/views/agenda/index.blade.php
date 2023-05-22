@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <br>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="user_id" name="user_id"
                                value="{{ auth()->user()->id }}" readonly>
                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="bi bi-calendar-minus"></i> Nama
                                    Kegiatan</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" required value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label"><i class="bi bi-mailbox2"></i>
                                    Target</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" required value="{{ old('description') }}">
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="task_date" class="form-label"><i class="bi bi-calendar"></i> Tanggal</label>
                                <input type="date" class="form-control @error('task_date') is-invalid @enderror"
                                    id="task_date" name="task_date" required value="{{ old('task_date') }}">
                                @error('task_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="latar" class="form-label"><i class="bi bi-mailbox2"></i> Warna
                                    Backgrond</label>
                                <input type="color"
                                    class="form-control form-control-color @error('latar') is-invalid @enderror" id="latar"
                                    name="latar" required value="#00a65a">
                                @error('latar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label"><i class="bi bi-mailbox2"></i> Warna Text</label>
                                <input type="color"
                                    class="form-control form-control-color @error('text') is-invalid @enderror" id="text"
                                    name="text" required value="{{ old('text') }}">
                                @error('text')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-info" style="float: left;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
