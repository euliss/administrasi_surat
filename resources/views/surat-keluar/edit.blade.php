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
            <form action="/surat-keluar/{{ $suratkeluar->id }}" method="POST" enctype="multipart/form-data">
                @method('put')
                @csrf
                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}"
                    readonly>
                @if (auth()->user()->jabatan === 'Pembina')
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="Tindaklanjuti" @selected(old('status', $suratkeluar->status) === 'Tindaklanjuti')>Tindaklanjuti</option>
                            <option value="Disetujui" @selected(old('status', $suratkeluar->status) === 'Disetujui')>Disetujui</option>
                            <option value="Ditolak" @selected(old('status', $suratkeluar->status) === 'Ditolak')>Ditolak</option>
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="komentar" class="form-label">Komentar</label>
                        <textarea class="form-control" id="komentar" name="komentar" rows="3">{{ $suratkeluar->komentar }}</textarea>
                        @error('komentar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @elseif (auth()->user()->jabatan === 'Sekretaris')
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                            <option value="Menunggu" @selected(old('status', $suratkeluar->status) == 'Menunggu')>Menunggu</option>
                            <option value="Tindaklanjuti" @selected(old('status', $suratkeluar->status) == 'Tindaklanjuti')>Tindaklanjuti</option>
                        </select>
                        @error('jabatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                <div class="mb-3">
                    <label for="nomor_surat" class="form-label"><i class="bi bi-list-ul"></i> Nomor Surat</label>
                    <input type="text" class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat"
                        name="nomor_surat" required value="{{ old('nomor_surat', $suratkeluar->nomor_surat) }}"
                        {{ auth()->user()->jabatan === 'Pembina' ? 'readonly' : '' }}>
                    @error('nomor_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                        name="tanggal" required value="{{ old('tanggal', $suratkeluar->tanggal) }}"
                        {{ auth()->user()->jabatan === 'Pembina' ? 'readonly' : '' }}>
                    @error('tanggal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tujuan_surat" class="form-label"><i class="bi bi-people"></i> Tujuan Surat </label>
                    <input type="text" class="form-control @error('tujuan_surat') is-invalid @enderror" id="tujuan_surat"
                        name="tujuan_surat" required value="{{ old('tujuan_surat', $suratkeluar->tujuan_surat) }}"
                        {{ auth()->user()->jabatan === 'Pembina' ? 'readonly' : '' }}>
                    @error('tujuan_surat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="perihal" class="form-label"><i class="bi bi-justify-left"></i>Perihal</label>
                    <input type="text" class="form-control @error('perihal') is-invalid @enderror" id="perihal"
                        name="perihal" required value="{{ old('perihal', $suratkeluar->perihal) }}"
                        {{ auth()->user()->jabatan === 'Pembina' ? 'readonly' : '' }}>
                    @error('perihal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ttd1" class="form-label">Ketuplak</label>
                    @if (auth()->user()->jabatan === 'Pembina')
                        <p>{{ $ket->name }}</p>
                    @else
                        <select class="form-select @error('ttd1') is-invalid @enderror" id="ttd1" name="ttd1">
                            @foreach ($ketuplak as $plak)
                                <option value="{{ $plak->id }}" @selected(old('ttd1', $suratkeluar->ketuplak) == $plak->id)>
                                    {{ $plak->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    @error('ttd1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ttd2" class="form-label">Sekretaris</label>
                    @if (auth()->user()->jabatan === 'Pembina')
                        <p>{{ $sek->name }}</p>
                    @else
                        <select class="form-select @error('ttd2') is-invalid @enderror" id="ttd2"
                            name="ttd2">
                            @foreach ($sekretaris as $sekre)
                                <option value="{{ $sekre->id }}" @selected(old('ttd2', $suratkeluar->sekretaris) == '{{ $sekre->id }}')>
                                    {{ $sekre->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    @error('ttd2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="ttd3" class="form-label">Ketua Himpunan</label>
                    @if (auth()->user()->jabatan === 'Pembina')
                        <p>{{ $kah->name }}</p>
                    @else
                        <select class="form-select @error('ttd3') is-invalid @enderror" id="ttd3" name="ttd3">
                            @foreach ($kahim as $him)
                                <option value="{{ $him->id }}" @selected(old('ttd3', $suratkeluar->kahim) == '{{ $him->id }}')>
                                    {{ $him->name }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                    @error('ttd3')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                @if (auth()->user()->jabatan === 'Pembina')
                    <div class="mb-3">
                        <label for="isi" class="form-label"><i class="bi bi-file-earmark-font"></i> Isi</label>
                        {!! $suratkeluar->isi !!}
                    </div>
                @else
                    <div class="mb-3">
                        <label for="isi" class="form-label"><i class="bi bi-file-earmark-font"></i> Isi</label>
                        <textarea class="form-control @error('isi') is-invalid @enderror" name="isi" id="surat_keluar" rows="3"
                            required {{ auth()->user()->jabatan === 'Pembina' ? 'readonly' : '' }}>{{ old('isi', $suratkeluar->isi) }}</textarea>
                        {{-- <input type="text" class="form-control @error('isi') is-invalid @enderror" id="isi" name="isi" required value="{{ old('isi', $suratkeluar->isi) }}"> --}}
                        @error('isi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                @endif
                @if (auth()->user()->jabatan !== 'Pembina')
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
        <i>*Surat keluar akan diteruskan ke Pembina untuk meminta persetujuan</i>
        <div class="d-flex justify-content-end mb-5">
            <a href="/surat-keluar" class="btn btn-secondary mx-4">Cancel</a>
            <button type="submit" class="btn btn-info">Save</button>
        </div>
        </form>
    </div>
@endsection
