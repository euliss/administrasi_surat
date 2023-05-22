@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/pengajuan">Pengajuan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <form action="/pengajuan/{{ $pengajuan->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                @if (auth()->user()->jabatan === 'Sekretaris')
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="Menunggu" @selected(old('status') == 'Menunggu')>Menunggu</option>
                            <option value="Tindaklanjuti" @selected(old('status') == 'Tindaklanjuti')>Tindaklanjuti</option>
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea class="form-control" id="komentar" name="komentar" rows="3">{{ $pengajuan->komentar }}</textarea>
                        @error('komentar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label"><i class="bi bi-list-ul"></i> Kategori Surat</label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                            name="kategori" required value="{{ old('kategori', $pengajuan->kategori) }}" readonly>
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal" required value="{{ old('tanggal', $pengajuan->tanggal) }}" readonly>
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tujuan_surat" class="form-label"><i class="bi bi-people"></i> Tujuan Surat
                        </label>
                        <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror"
                            id="tujuan_surat" name="tujuan_surat" required
                            value="{{ old('tujuan_surat', $pengajuan->tujuan_surat) }}" readonly>
                        @error('tujuan_surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label"><i class="bi bi-justify-left"></i>Perihal</label>
                        <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                            name="perihal" required value="{{ old('perihal', $pengajuan->perihal) }}" readonly>
                        @error('perihal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="berkas" class="form-label"> Berkas</label>
                        <input class="form-control @error('berkas') is-invalid @enderror" type="file" id="berkas"
                            name="berkas" readonly>
                        @error('berkas')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="kategori" class="form-label"><i class="bi bi-list-ul"></i> Kategori Surat</label>
                        <input type="text" class="form-control @error('kategori') is-invalid @enderror" id="kategori"
                            name="kategori" required value="{{ old('kategori', $pengajuan->kategori) }}">
                        @error('kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal" required value="{{ old('tanggal', $pengajuan->tanggal) }}">
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tujuan_surat" class="form-label"><i class="bi bi-people"></i> Tujuan Surat
                        </label>
                        <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror"
                            id="tujuan_surat" name="tujuan_surat" required
                            value="{{ old('tujuan_surat', $pengajuan->tujuan_surat) }}">
                        @error('tujuan_surat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label"><i class="bi bi-justify-left"></i>Perihal</label>
                        <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                            name="perihal" required value="{{ old('perihal', $pengajuan->perihal) }}">
                        @error('perihal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
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
                @endif
        </div>
        <i>*Pengajuan akan diteruskan ke Sekretaris untuk penindaklanjutan, setelah itu diteruskan ke pembina untuk
            persetujuan</i>
        <div class="d-flex justify-content-end mb-5">
            <a href="/pengajuan" class="btn btn-secondary mx-4">Cancel</a>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        </form>
    </div>
@endsection
