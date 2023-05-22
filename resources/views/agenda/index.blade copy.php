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
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
{{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<br>
<div class="row">
<div class="col-lg-4">
<div class="card">
<div class="card-body">
<form action="/agenda" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ auth()->user()->id }}" readonly>
<div class="mb-3">
<label for="nama" class="form-label"><i class="bi bi-calendar-minus"></i> Nama Kegiatan</label>
<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required value="{{ old('nama') }}">
@error('nama')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror
</div>
<div class="mb-3">
<label for="target" class="form-label"><i class="bi bi-mailbox2"></i> Target</label>
<input type="text" class="form-control @error('target') is-invalid @enderror" id="target" name="target" required value="{{ old('target') }}">
@error('target')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror

</div>
<div class="mb-3">
<label for="tanggal" class="form-label"><i class="bi bi-calendar"></i> Tanggal</label>
<input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required value="{{ old('tanggal') }}">
@error('tanggal')
<div class="invalid-feedback">
{{ $message }}
</div>
@enderror
</div>
<div class="">
<button type="submit" class="btn btn-info" style="float: left;">Save</button>
<a href="#" class="btn btn-danger mx-4" style="float: right;">Delete</a>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection