@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/arsip">Arsip</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (auth()->user()->jabatan === 'Sekretaris')
            <a href="/surat-masuk/create" class="btn btn-info text-white m-3"><i class="bi bi-envelope-plus"></i> Tambah
                Data</a>
        @else
            <div class="my-5">
            </div>
        @endif
        <div class="table-responsive bg-white text-center">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Surat</th>
                                <th>Tanggal</th>
                                <th>Asal Surat</th>
                                <th>Perihal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratmasuk as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->nomor_surat }}</td>
                                    <td>{{ $surat->tanggal }}</td>
                                    <td>{{ $surat->asal_surat }}</td>
                                    <td>{{ $surat->perihal }}</td>
                                    <td>
                                        @if (auth()->user()->jabatan !== 'Sekretaris')
                                            <a href="/surat-masuk/{{ $surat->id }}" class="btn btn-success"><i
                                                    class="bi bi-eye"></i></a>
                                        @else
                                            <a href="/surat-masuk/{{ $surat->id }}" class="btn btn-success"><i
                                                    class="bi bi-eye"></i></a>
                                            <a href="/surat-masuk/{{ $surat->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil"></i></a>
                                            <form action="/surat-masuk/{{ $surat->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                                    value="{{ auth()->user()->id }}" readonly>
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Hapus Data?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="table-responsive bg-white text-center">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h2 class="card-title text-bold">Riwayat</h2><br>
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Detail</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayat as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->nama }}</td>
                                    <td>{{ $r->keterangan }}</td>
                                    <td>{{ $r->detail }}</td>
                                    <td>{{ $r->created_at->diffforhumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="d-flex justify-content-end">
            {{-- {{ $suratmasuk->links() }} --}}
        </div>
        {{-- @if (auth()->user()->jabatan === 'Sekretaris')
            <div class="d-flex justify-content-end">
                <a href="/" class="btn btn-info text-white"><i class="bi bi-printer"></i> Cetak Rekap</a>
            </div>
        @endif --}}
    </div>
@endsection
