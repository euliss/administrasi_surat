@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/absensi">Absensi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/absensi">
                        < Kembali ke halaman Absensi</a>
                </div>
                <div>
                    @if (auth()->user()->jabatan !== 'Pengurus')
                        <a href="/absensi/{{ $absensi->id }}/print" class="btn btn-info" target="_blank"><i
                                class="bi bi-printer-fill">
                                Print</i></a>
                    @endif
                    @if (auth()->user()->jabatan === 'Sekretaris')
                        <a href="/absensi/{{ $absensi->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil">
                                Edit</i></a>
                        <form action="/absensi/{{ $absensi->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i
                                    class="bi bi-trash"></i> Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            <h3 class="ms-3">{{ $title }}</h3>
            <table class="m-3" style="width: 300px">
                <tr>
                    <th>Nama Kegiatan</th>
                    <td>:</td>
                    <td>{{ $absensi->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $absensi->tanggal }}</td>
                </tr>
                <tr>
                    <th>Jumlah Hadir</th>
                    <td>:</td>
                    <td>{{ $absensi->hadir }} Orang</td>
                </tr>
                <tr>
                    <th>Jumlah Tidak Hadir</th>
                    <td>:</td>
                    <td>{{ $absensi->tidak_hadir }} Orang</td>
                </tr>
            </table>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <div class="col-md-12">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Kehadiran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->user->name }}</td>
                                <td>{{ $d->user->jabatan }}</td>
                                <td>{{ $d->kehadiran }}</td>
                                <td>{{ $d->keterangan ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
