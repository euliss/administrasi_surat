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
        <form action="/absensi" method="POST">
            @csrf
            <div class=" row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
                <div class="col-md-12">
                    <input type="hidden" class="form-control" id="user_id" name="user_id"
                        value="{{ auth()->user()->id }}" readonly>
                    <div class="mb-3">
                        <label for="nama" class="form-label"><i class="bi bi-list-ul"></i> Nama Kegiatan</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                            name="nama" required value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label"><i class="bi bi-calendar-minus"></i> Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal" required value="{{ old('tanggal') }}">
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center align-middle">
                            <thead>
                                <tr style="vertical-align: middle">
                                    <th style="vertical-align: middle">No</th>
                                    <th style="vertical-align: middle">Nama</th>
                                    <th style="vertical-align: middle">Jabatan</th>
                                    <th class="text-center pt-4" style="vertical-align: middle">
                                        Hadir <br>
                                        <input type="radio" name="hadir_semua" id="hadir_semua" onclick="hadirSemua()">
                                    </th>
                                    <th class="text-center" style="vertical-align: middle">Tidak Hadir</th>
                                    <th class="text-center" style="vertical-align: middle">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensi as $ab)
                                    <tr class="text-center">
                                        <input type="hidden" class="form-control" id="anggota{{ $loop->iteration }}"
                                            name="anggota{{ $loop->iteration }}" value="{{ $ab->id }}" readonly>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ab->name }}</td>
                                        <td>{{ $ab->jabatan }}</td>
                                        <td class="text-center">
                                            <input type="radio"
                                                class="@error('kehadiran{{ $loop->iteration }}') is-invalid @enderror"
                                                name="kehadiran{{ $loop->iteration }}"
                                                id="hadir{{ $loop->iteration }}" value="hadir"
                                                @checked(old('kehadiran{{ $loop->iteration }}') == 'hadir') onclick="f_hadir{{ $loop->iteration }}()">
                                            @error('kehadiran{{ $loop->iteration }}')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td class="text-center">
                                            <input type="radio"
                                                class="@error('kehadiran{{ $loop->iteration }}') is-invalid @enderror"
                                                name="kehadiran{{ $loop->iteration }}"
                                                id="tidak_hadir{{ $loop->iteration }}" value="tidak hadir"
                                                @checked(old('kehadiran{{ $loop->iteration }}') == 'tidak hadir')
                                                onclick="tidakHadir{{ $loop->iteration }}()">
                                            @error('kehadiran{{ $loop->iteration }}')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                        <td class="text-center">
                                            <select name="keterangan{{ $loop->iteration }}"
                                                class="form-select @error('keterangan{{ $loop->iteration }}') is-invalid @enderror"
                                                id="keterangan{{ $loop->iteration }}">
                                                <option value="-" @selected(old('keterangan{{ $loop->iteration }}') == '-')>-</option>
                                                <option value="sakit" @selected(old('keterangan{{ $loop->iteration }}') == 'sakit')>Sakit</option>
                                                <option value="izin" @selected(old('keterangan{{ $loop->iteration }}') == 'izin')>Izin</option>
                                            </select>
                                            @error('kehadiran{{ $loop->iteration }}')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </td>
                                    </tr>
                                    <input type="hidden" class="form-control" id="jumlah" name="jumlah"
                                        value="{{ $loop->iteration }}" readonly>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function hadirSemua() {
            var btns = document.querySelectorAll('input[type="radio"]')
            for (var i = 0; i < btns.length; i++) {
                if (btns[i].value == "hadir")
                    btns[i].checked = true;
            }
            @foreach ($absensi as $ab)
                document.getElementById('keterangan{{ $loop->iteration }}').disabled = true;
            @endforeach
        }
        @foreach ($absensi as $ab)
            const hadir{{ $loop->iteration }} = document.getElementById('hadir{{ $loop->iteration }}')
            const tidak_hadir{{ $loop->iteration }} = document.getElementById('tidak_hadir{{ $loop->iteration }}')
            const keterangan{{ $loop->iteration }} = document.getElementById('keterangan{{ $loop->iteration }}')

            function f_hadir{{ $loop->iteration }}() {
                keterangan{{ $loop->iteration }}.disabled = true;
            }

            function tidakHadir{{ $loop->iteration }}() {
                keterangan{{ $loop->iteration }}.disabled = false;
            }
        @endforeach
    </script>
@endsection
