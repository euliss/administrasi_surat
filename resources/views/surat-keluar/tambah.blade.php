@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/arsip">Arsip</a></li>
                    <li class="breadcrumb-item"><a href="/surat-keluar">Surat Keluar</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <form action="/surat-keluar/tambah" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" id="surat_id" name="surat_id" value="{{ $pengajuan->id }}"
                    readonly>
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                <div class="mb-3">
                    <label for="status" class="form-label">Kategori : </label> {{ $pengajuan->kategori }}
                    <input type="hidden" class="form-control" id="kategori" name="kategori"
                        value="{{ $pengajuan->kategori }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Pengaju : </label> {{ $pengajuan->user->name }}
                    <input type="hidden" class="form-control" id="pengajuan_id" name="pengajuan_id"
                        value="{{ $pengajuan->id }}" readonly>
                </div>
                @if (auth()->user()->jabatan === 'Pembina')
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="Tindaklanjuti" @selected(old('status', $pengajuan->status) === 'Tindaklanjuti')>Tindaklanjuti</option>
                            <option value="Disetujui" @selected(old('status', $pengajuan->status) === 'Disetujui')>Disetujui</option>
                            <option value="Ditolak" @selected(old('status', $pengajuan->status) === 'Ditolak')>Ditolak</option>
                        </select>
                        @error('status')
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
                @endif
                <label for="nomor_surat" class="form-label"><i class="bi bi-list-ul"></i> Nomor Surat</label>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">{{ $nomor }}</span>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat"
                        name="nomor_surat" required value="{{ old('nomor_surat', $pengajuan->nomor_surat) }}">
                    @error('nomor_surat')
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
                    <label for="tujuan_surat" class="form-label"><i class="bi bi-people"></i> Tujuan Surat </label>
                    <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat"
                        name="tujuan_surat" required value="{{ old('tujuan_surat', $pengajuan->tujuan_surat) }}">
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
                @if ($pengajuan->kategori == 'surat undangan')
                    <div class="mb-3">
                        <label for="ttd2" class="form-label">Sekretaris</label>
                        <select class="form-select @error('ttd2') is-invalid @enderror" id="ttd2" name="ttd2">
                            @foreach ($sekretaris as $sekre)
                                <option value="{{ $sekre->id }}" @selected(old('ttd2') == '{{ $sekre->id }}')>
                                    {{ $sekre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ttd2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ttd3" class="form-label">Ketua Himpunan</label>
                        <select class="form-select @error('ttd3') is-invalid @enderror" id="ttd3" name="ttd3">
                            @foreach ($kahim as $sekre)
                                <option value="{{ $sekre->id }}" @selected(old('ttd3') == '{{ $sekre->id }}')>
                                    {{ $sekre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ttd3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="ttd1" class="form-label">Ketuplak</label>
                        <select class="form-select @error('ttd1') is-invalid @enderror" id="ttd1" name="ttd1">
                            @foreach ($ketuplak as $plak)
                                <option value="{{ $plak->id }}" @selected(old('ttd1') == '{{ $plak->id }}')>
                                    {{ $plak->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ttd1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ttd2" class="form-label">Sekretaris</label>
                        <select class="form-select @error('ttd2') is-invalid @enderror" id="ttd2" name="ttd2">
                            @foreach ($sekretaris as $sekre)
                                <option value="{{ $sekre->id }}" @selected(old('sekretaris') == '{{ $sekre->id }}')>
                                    {{ $sekre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('sekretaris')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ttd3" class="form-label">Ketua Himpunan</label>
                        <select class="form-select @error('ttd3') is-invalid @enderror" id="ttd3" name="ttd3">
                            @foreach ($kahim as $sekre)
                                <option value="{{ $sekre->id }}" @selected(old('ttd3') == '{{ $sekre->id }}')>
                                    {{ $sekre->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ttd3')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                <div class="mb-3">
                    <label for="isi" class="form-label"><i class="bi bi-file-earmark-font"></i> Isi</label>
                    <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="surat_keluar" rows="3"
                        required>{{ old('isi') }}</textarea>
                    {{-- <input type="text" class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" required value="{{ old('isi', $suratkeluar->isi) }}"> --}}
                    @error('isi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="berkas" class="form-label"> Berkas</label>
                    <p>{{ $pengajuan->berkas }}</p>
                    <input class="form-control @error('berkas') is-invalid @enderror" type="file" id="berkas"
                        name="berkas">
                    @error('berkas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
        </div>
        <i>*Surat keluar akan diteruskan ke Pembina untuk meminta persetujuan</i>
        <div class="d-flex justify-content-end mb-5">
            <a href="/surat-keluar" class="btn btn-secondary mx-4">Cancel</a>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        </form>
    </div>
@endsection
