<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi {{ $absensi->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                margin: 0;
            }

            .kiri {
                margin-right: 100px;
            }

            .kanan {
                margin-left: 100px;
            }
        }

        html {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
        }

        body {
            margin: 0 auto;
            width: 21cm;
            height: 29.7cm;
            /* margin: 30mm 45mm 30mm 45mm; */
            /* change the margins as you want them to be. */
        }

        img {
            width: 800px;
        }

    </style>
</head>

<body class="lh-base mt-3" style="font-family: 'Times New Roman', Times, serif;">
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3">
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
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3">
            <div class="col-md-12">
                <table class="table table-bordered border-dark text-center">
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
                                <td>{{ $d->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        window.onload = window.print;
    </script>
</body>

</html>
