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
        @if (auth()->user()->jabatan === 'Sekretaris')
            <div class="row text-center my-4 d-flex justify-content-between">
                <div class="col-lg-3">
                    <a href="/surat-masuk/create" class="btn btn-info text-white m-3"><i class="bi bi-envelope-plus"></i>
                        Tambah Surat Masuk</a>
                </div>
                <div class="col-lg-3">
                    <a href="/surat-keluar/create" class="btn btn-success text-white m-3"><i
                            class="bi bi-envelope-plus"></i> Tambah Surat Keluar</a>
                </div>
                <div class="col-lg-3">
                    <a href="/lainnya/create" class="btn btn-warning text-white m-3"><i class="bi bi-envelope-plus"></i>
                        Tambah Dokumen Lainnya</a>
                </div>
                <div class="col-lg-3">
                    <a href="/absensi/create" class="btn btn-danger text-white m-3"><i class="bi bi-envelope-plus"></i>
                        Tambah Absensi</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $suratmasuk }}</h3>

                        <p>Surat Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-file-earmark-arrow-down text-light" style="font-size: 4em"></i>
                    </div>
                    <a href="/surat-masuk" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $suratkeluar }}</h3>

                        <p>Surat Keluar</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-file-earmark-arrow-up text-light" style="font-size: 4em"></i>
                    </div>
                    <a href="/surat-keluar" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner text-light">
                        <h3>{{ $dokumen }}</h3>

                        <p>Dokumen Lainnya</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-file-earmark text-light" style="font-size: 4em"></i>
                    </div>
                    <a href="/lainnya" class="small-box-footer text-light" style="color: white">More info <i
                            class="fas fa-arrow-circle-right text-light"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $absensi }}</h3>

                        <p>Total Absensi</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-clipboard-check text-light" style="font-size: 4em"></i>
                    </div>
                    <a href="/lainnya" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div>
@endsection
