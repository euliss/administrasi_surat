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
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/pengajuan">
                        < Kembali ke halaman Pengajuan</a>
                </div>
                <div>
                    <a href="/pengajuan/{{ $pengajuan->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-fill">
                            Edit</i></a>
                    <form action="/pengajuan/{{ $pengajuan->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i
                                class="bi bi-trash-fill"></i> Delete</button>
                    </form>
                </div>
            </div>
            <h3 class="ms-3">{{ $title }}</h3>
            <table class="m-3" style="width: 400px">
                <tr>
                    <th>Nomor Surat Keluar</th>
                    <td>:</td>
                    <td>{{ $pengajuan->suratMasuk_id ?? 'Belum Ditindaklanjuti' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td><span
                            class="badge @if ($pengajuan->status === 'Disetujui') bg-success @elseif ($pengajuan->status === 'Ditolak') bg-danger @elseif ($pengajuan->status === 'Tindaklanjuti') bg-warning @else bg-secondary @endif">{{ $pengajuan->status }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Komentar</th>
                    <td>:</td>
                    <td>{{ $pengajuan->komentar }}</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td>:</td>
                    <td>{{ $pengajuan->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $pengajuan->tanggal }}</td>
                </tr>
                <tr>
                    <th>Tujuan Surat</th>
                    <td>:</td>
                    <td>{{ $pengajuan->tujuan_surat }}</td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td>:</td>
                    <td>{{ $pengajuan->perihal }}</td>
                </tr>
                <tr>
                    <th>Berkas</th>
                    <td>:</td>
                    <td><a href="{{ asset('/storage/' . $pengajuan->berkas) }}" class="btn btn-info" download><i
                                class="bi bi-download"></i> Unduh</a></td>
                </tr>
            </table>
        </div>
        <i>*Pengajuan akan diteruskan ke Sekretaris untuk penindaklanjutan, setelah itu diteruskan ke pembina untuk
            persetujuan</i>
    </div>
@endsection
