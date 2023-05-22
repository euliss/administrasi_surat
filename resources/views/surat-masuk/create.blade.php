@extends('layouts.dashboard')

@section('container')
    <div class="container">
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="/arsip">Arsip</a></li>
              <li class="breadcrumb-item"><a href="/surat-masuk">Surat Masuk</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
          </nav>
       </div>
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
        <form action="/surat-masuk" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" readonly>
          <div class="mb-3">
            <label for="nomor_surat" class="form-label"><i class="bi bi-list-ul"></i> Nomor Surat</label>
            <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" required value="{{ old('nomor_surat') }}">
            @error('nomor_surat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}">
            @error('tanggal')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="asal_surat" class="form-label"><i class="bi bi-mailbox2"></i> Asal Surat</label>
            <input type="text" class="form-control @error('asal_surat') is-invalid @enderror" id="asal_surat" name="asal_surat" required value="{{ old('asal_surat') }}">
            @error('asal_surat')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
         </div>
          <div class="mb-3">
            <label for="perihal" class="form-label"><i class="bi bi-justify-left"></i> Perihal</label>
            <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal" name="perihal" required value="{{ old('perihal') }}">
            @error('perihal')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
         </div>
         <div class="mb-3">
            <label for="berkas" class="form-label"> Berkas</label>
            <input class="form-control @error('berkas') is-invalid @enderror" type="file" id="berkas" name="berkas">
            @error('berkas')
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