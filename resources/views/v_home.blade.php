@extends('layouts.dashboard')

@section('container')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="bg-white p-2 pt-3 mb-3 rounded-3 shadow-sm">
                    <h5><i class="bi bi-info-circle"></i> Selamat datang di Sistem Informasi Manajemen Administrasi.
                        Anda Login
                        sebagai {{ auth()->user()->jabatan }}</h5>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div><!-- /.col -->

                <!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
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
                        <a href="/surat-masuk" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="/surat-keluar" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <center>
                    <section class="col-lg-10">
                        <div class="card p-3">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </section>
                </center>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
