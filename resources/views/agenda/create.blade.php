@extends('layouts.dashboard')

@section('container')
    <div class="container">
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
            <form action="/agenda" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                <div class="mb-3">
                    <label for="tanggal" class="form-label"><i class="bi bi-list-ul"></i> Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" required value="{{ old('tanggal') }}">
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama" class="form-label"><i class="bi bi-calendar-minus"></i> Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama"
                        required value="{{ old('nama') }}">
                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="target" class="form-label"><i class="bi bi-mailbox2"></i> Target</label>
                    <input type="text" class="form-control @error('target') is-invalid @enderror" id="target" name="target"
                        required value="{{ old('target') }}">
                    @error('target')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="latar" class="form-label"><i class="bi bi-mailbox2"></i> Warna Backgrond</label>
                    <input type="color" class="form-control @error('latar') is-invalid @enderror" id="latar" name="latar"
                        required value="{{ old('latar') }}">
                    @error('latar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label"><i class="bi bi-mailbox2"></i> Warna Text</label>
                    <input type="color" class="form-control @error('text') is-invalid @enderror" id="text" name="text"
                        required value="{{ old('text') }}">
                    @error('text')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/surat-masuk" class="btn btn-secondary mx-4">Cancel</a>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
