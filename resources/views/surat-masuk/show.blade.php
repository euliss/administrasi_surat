@extends('layouts.dashboard')

@section('container')
<div class="container">
  <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/arsip">Arsip</a></li>
        <li class="breadcrumb-item"><a href="/surat-masuk">Surat Masuk</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
      </ol>
    </nav>
  </div>
  <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
    <div class="d-flex justify-content-between">
      <div>
          <a href="/surat-masuk">< Kembali ke halaman Surat Masuk</a>
      </div>
      <div>
        @if (auth()->user()->jabatan === 'Sekretaris')
        <a href="/surat-masuk/{{ $suratmasuk->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil"> Edit</i></a>
        <form action="/surat-masuk/{{ $suratmasuk->id }}" method="post" class="d-inline">
           @method('delete')
           @csrf
           <input type="hidden" class="form-control" id="user_id" name="user_id"
           value="{{ auth()->user()->id }}" readonly>
           <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i class="bi bi-trash"></i> Delete</button>
         </form>
        @endif
      </div>
    </div>
    <h3 class="ms-3">{{ $title }}</h3>
    <table class="m-3" style="width:300px">
      <tr>
        <th>Nomor Surat</th>
        <td>:</td>
        <td>{{ $suratmasuk->nomor_surat }}</td>
      </tr>
      <tr>
        <th>Tanggal</th>
        <td>:</td>
        <td>{{ $suratmasuk->tanggal }}</td>
      </tr>
      <tr>
        <th>Asal Surat</th>
        <td>:</td>
        <td>{{ $suratmasuk->asal_surat }}</td>
      </tr>
      <tr>
        <th>Perihal</th>
        <td>:</td>
        <td>{{ $suratmasuk->perihal }}</td>
      </tr>
      <tr>
        <th>Berkas</th>
        <td>:</td>
        <td><a href="{{ asset('/storage/'.$suratmasuk->berkas) }}" class="btn btn-info" download><i class="bi bi-download"></i> Unduh</a></td>
      </tr>
    </table>
  </div>
</div>
@endsection