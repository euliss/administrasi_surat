@extends('layouts.dashboard')

@section('container')
    <div class="container mb-5">
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
               <li class="breadcrumb-item"><a href="/surat-masuk">Surat Masuk</a></li>
               <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
          </nav>
       </div>
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
          <div class="d-flex justify-content-between">
            <div>
                <a href="/lainnya">< Kembali ke halaman Dokumen Lainnya</a>
            </div>
         </div>
         <h3 class="my-4">{{ $title }}</h3>
        <form method="post" action="/lainnya/{{ $dokumen->id }}" enctype="multipart/form-data">
          @method('put')
          @csrf
          <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" readonly>
          <div class="mb-3">
            <label for="nama" class="form-label"><i class="bi bi-list-ul"></i> Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required value="{{ old('nama', $dokumen->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
         <div class="mb-3">
            <label for="berkas" class="form-label"> Berkas</label>
            <input type="hidden" name="oldBerkas" value="{{ $dokumen->berkas }}">
            <input class="form-control @error('berkas') is-invalid @enderror" type="file" id="berkas" name="berkas">
            @error('berkas')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
          <div class="d-flex justify-content-end">
            <a href="/lainnya" class="btn btn-secondary mx-4">Cancel</a>
            <button type="submit" class="btn btn-info">Save</button> 
          </div>
        </form>
      </div>
    </div>
@endsection