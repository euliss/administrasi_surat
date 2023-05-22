<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Keluar {{ $surat->nomor_surat }}</title>
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
    <center>
        <img src="{{ asset('img/kop_surat.png') }}" alt="">
    </center>
    <div class="tanggal text-end me-5">
        <p>Subang, {{ $tanggal }}</p>
    </div>
    <div class="keterangan ms-5 w-50">
        <table class="table table-borderless lh-1">
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>{{ $surat->nomor_surat }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>
                    {{ $surat->count('berkas') ? $surat->count('berkas') . ' (Halaman)' : '-' }}
                </td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>:</td>
                <th>{{ $surat->perihal }}</th>
            </tr>
        </table>
    </div>
    <div class="isi m-5" style="text-indent: 50px; text-align: justify">
        {!! $surat->isi !!}
    </div>
    @if ($surat->kategori != 'surat undangan')
        <div class="ttd">
            <div class="row text-center tengah">
                <p class="mb-4">Hormat Kami,</p>
                <div class="d-flex justify-content-center mb-4">
                    <div class="col-md-6 kiri">
                        <p class="pb-5">Ketua Pelaksana</p>
                        <p class="fw-bold text-decoration-underline mb-0">{{ $ketuplak->name }}</p>
                        <p class="fw-bold" style="margin-top: -5px">NIM.
                            {{ $ketuplak->nomor_induk }}
                        </p>
                    </div>
                    <div class="col-md-6 kanan">
                        <p class="pb-5">Sekretaris</p>
                        <p class="fw-bold text-decoration-underline mb-0">{{ $sekretaris->name }}</p>
                        <p class="fw-bold" style="margin-top: -5px">NIM. {{ $sekretaris->nomor_induk }}</p>
                    </div>
                </div>
            </div>
            <div class="row text-center mt-3">
                <p class="mb-4">Mengetahui,</p>
                <p class="pb-5">Ketua Himpunan</p>
                <p class="fw-bold text-decoration-underline mb-0">{{ $kahim->name }}</p>
                <p class="fw-bold" style="margin-top: -5px">NIM. {{ $kahim->nomor_induk }}</p>
            </div>
        </div>
    @else
        <div class="ttd">
            <div class="row text-center tengah">
                <p class="mb-4">Hormat Kami,</p>
                <div class="d-flex justify-content-center mb-4">
                    <div class="col-md-6 kiri">
                        <p class="pb-5">Ketua Himpunan</p>
                        <p class="fw-bold text-decoration-underline mb-0">{{ $kahim->name }}</p>
                        <p class="fw-bold" style="margin-top: -5px">NIM.
                            {{ $kahim->nomor_induk }}
                        </p>
                    </div>
                    <div class="col-md-6 kanan">
                        <p class="pb-5">Sekretaris</p>
                        <p class="fw-bold text-decoration-underline mb-0">{{ $sekretaris->name }}</p>
                        <p class="fw-bold" style="margin-top: -5px">NIM. {{ $sekretaris->nomor_induk }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>

    <script>
        window.onload = window.print;
    </script>
</body>

</html>
