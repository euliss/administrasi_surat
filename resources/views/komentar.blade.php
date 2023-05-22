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
  <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
    <form>
      <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label"><i class="bi bi-chat-text-fill"></i> Komentar Surat</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
  </div>
  <div class="d-flex justify-content-end">
    <a href="/home" class="btn btn-secondary mx-4">Cancel</a>
    <button type="submit" class="btn btn-info">Save</button>
  </div>
  </form>
</div>
@endsection