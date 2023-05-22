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
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <form action="/pengajuan" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                <div class="mb-3">
                    <label for="kategori" class="form-label"><i class="bi bi-list-ul"></i> Kategori Surat:</label>
                    <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                        <option value="surat undangan" @selected(old('kategori') == 'surat undangan')>Surat Undangan
                        </option>
                        <option value="surat peminjaman" @selected(old('kategori') == 'surat peminjaman')>Surat Peminjaman
                        </option>
                        <option value="surat permohonan" @selected(old('kategori') == 'surat permohonan')>Surat Permohonan
                        </option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" value="{{ $tanggal }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tujuan_surat" class="form-label"><i class="bi bi-people"></i> Tujuan Surat </label>
                    <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat"
                        name="tujuan_surat" value="{{ old('tujuan_surat') }}" required>
                    @error('tujuan_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="perihal" class="form-label"><i class="bi bi-justify-left"></i>Perihal</label>
                    <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                        name="perihal" value="{{ old('perihal') }}" required>
                    @error('perihal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label for="isi" class="form-label"><i class="bi bi-file-earmark-font"></i> Isi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="surat_keluar" rows="3"
                        required>{{ old('isi') }}</textarea>
                    @error('isi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="berkas" class="form-label"> Berkas</label>
                    <input class="form-control @error('berkas') is-invalid @enderror" type="file" id="berkas"
                        name="berkas">
                    @error('berkas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/pengajuan" class="btn btn-danger mx-4">Cancel</a>
                    <button type="submit" class="btn btn-info">Send</button>
                </div>
            </form>
        </div>
        <i>*Pengajuan surat akan diteruskan ke Sekretaris untuk ditindak lanjuti</i>
    </div>
@endsection
