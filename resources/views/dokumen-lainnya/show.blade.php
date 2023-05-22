@extends('layouts.dashboard')

@section('container')
    <div class="container">
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
         <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="/user">Arsip</a></li>
              <li class="breadcrumb-item"><a href="/user">Dokumen Lainnya</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
          </nav>
       </div>
       <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
        <div class="d-flex justify-content-between">
          <div>
              <a href="/lainnya">< Kembali ke halaman Dokumen Lainnya</a>
          </div>
          <div>
            @if (auth()->user()->jabatan === 'Sekretaris')
            <a href="/lainnya/{{ $dokumen->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil"> Edit</i></a>
            <form action="/lainnya/{{ $dokumen->id }}" method="post" class="d-inline">
               @method('delete')
               @csrf
               <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i class="bi bi-trash"></i> Delete</button>
             </form>
            @endif
          </div>
        </div>
        <h3 class="ms-3">{{ $title }}</h3>
        <table class="m-3">
          <tr>
            <th>Nama</th>
            <td>:</td>
            <td>{{ $dokumen->nama }}</td>
          </tr>
          <tr>
            <th>Berkas</th>
            <td>:</td>
            <td><a href="{{ $dokumen->berkas }}"><button class="btn btn-info"><i class="bi bi-download"> </i>Unduh</button></a></td>
          </tr>
        </table>
      </div>
    </div>
@endsection