@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
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
            <a href="/absensi/create" class="btn btn-info text-white m-3"><i class="bi bi-envelope-plus"></i> Tambah Data</a>
        @else
            <div class="my-5">
            </div>
        @endif
        <div class="table-responsive my-3 bg-white text-center">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Kegiatan</th>
                                <th>Hadir</th>
                                <th>Tidak Hadir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absensi as $ab)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ab->tanggal }}</td>
                                    <td>{{ $ab->nama }}</td>
                                    <td>{{ $ab->hadir }}</td>
                                    <td>{{ $ab->tidak_hadir }}</td>
                                    <td>
                                        @if (auth()->user()->jabatan !== 'Sekretaris')
                                            <a href="/absensi/{{ $ab->id }}" class="btn btn-success"><i
                                                    class="bi bi-eye"></i></a>
                                        @else
                                            <a href="/absensi/{{ $ab->id }}" class="btn btn-success"><i
                                                    class="bi bi-eye"></i></a>
                                            <a href="/absensi/{{ $ab->id }}/edit" class="btn btn-warning"><i
                                                    class="bi bi-pencil"></i></a>
                                            <form action="/absensi/{{ $ab->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
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
        <div class="d-flex justify-content-end">
            {{ $absensi->links() }}
        </div>
    </div>
@endsection
