@extends('layouts.dashboard')

@section('container')
    <div class="container mb-5">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <form method="post" action="/user/{{ $user->username }}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
                <h3>{{ $title }}</h3>
                <div class="text-center w-100">
                    <i class="bi bi-person-circle fs-1"></i>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_induk" class="form-label">Nomor Induk</label>
                    <input type="text" class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk"
                        nomor_induk="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}">
                    @error('nomor_induk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username', $user->username) }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        value="{{ old('email', $user->email) }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Foto Profil <small>(max: 16mb)</small></label>
                    <input type="hidden" name="oldImage" value="{{ $user->image }}">
                    @if ($user->image)
                        <img src="{{ asset('/storage/' . $user->image) }}" alt="Foto Profil {{ $user->name }}"
                            class="img-preview img-fluid w-25 my-3 d-block">
                    @else
                        <img class="img-preview img-fluid w-25 my-3">
                    @endif
                    <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
                        onchange="previewImage()">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="/home" class="btn btn-secondary mx-4">Cancel</a>
                <button type="submit" class="btn btn-info">Save</button>
            </div>
        </form>
    </div>
    <script>
        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
