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
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/surat-keluar">
                        < Kembali ke halaman Surat Keluar</a>
                </div>
                <div>
                    <a href="/surat-keluar/{{ $suratkeluar->id }}/print" class="btn btn-info" target="_blank"><i
                            class="bi bi-printer-fill">
                            Print</i></a>
                    @if (auth()->user()->jabatan == 'Pembina')
                        <a href="/surat-keluar/{{ $suratkeluar->id }}/edit" class="btn btn-warning"><i
                                class="bi bi-pencil-fill">
                                Edit</i></a>
                    @endif
                    @if (auth()->user()->jabatan == 'Sekretaris')
                        <a href="/surat-keluar/{{ $suratkeluar->id }}/edit" class="btn btn-warning"><i
                                class="bi bi-pencil-fill">
                                Edit</i></a>
                        <form action="/surat-keluar/{{ $suratkeluar->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i
                                    class="bi bi-trash-fill"></i> Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            <h3 class="ms-3">{{ $title }}</h3>
            <table class="m-3" style="width: 400px">
                <tr>
                    <th>Diajukan oleh</th>
                    <td>:</td>
                    <td>{{ $pengaju }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td><span
                            class="badge @if ($suratkeluar->status === 'Disetujui') bg-success @elseif ($suratkeluar->status === 'Ditolak') bg-danger @elseif ($suratkeluar->status === 'Tindaklanjuti') bg-warning @else bg-secondary @endif">{{ $suratkeluar->status }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Komentar</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->komentar }}</td>
                </tr>
                <tr>
                    <th>&nbsp;</th>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th>Kategori</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->kategori }}</td>
                </tr>
                <tr>
                    <th>Nomor Surat</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->nomor_surat }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->tanggal }}</td>
                </tr>
                <tr>
                    <th>Tujuan Surat</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->tujuan_surat }}</td>
                </tr>
                <tr>
                    <th>Perihal</th>
                    <td>:</td>
                    <td>{{ $suratkeluar->perihal }}</td>
                </tr>
                @if ($suratkeluar->kategori != 'surat undangan')
                    <tr>
                        <th>Ketua Pelaksana</th>
                        <td>:</td>
                        <td>{{ $ketuplak->name }}</td>
                    </tr>
                @endif
                <tr>
                    <th>Sekretaris</th>
                    <td>:</td>
                    <td>{{ $sekretaris->name }}</td>
                </tr>
                <tr>
                    <th>Ketua Himpunan</th>
                    <td>:</td>
                    <td>{{ $kahim->name }}</td>
                </tr>
                <tr>
                    <th>Berkas</th>
                    <td>:</td>
                    <td><a href="{{ asset('/storage/' . $suratkeluar->berkas) }}" class="btn btn-info" download><i
                                class="bi bi-download"></i> Unduh</a></td>
                </tr>
                <tr>
                    <th>Isi</th>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            <div class="p-5">
                {!! $suratkeluar->isi !!}
            </div>
        </div>
        <i>*Surat keluar akan diteruskan ke Pembina untuk meminta persetujuan</i>
    </div>
@endsection
