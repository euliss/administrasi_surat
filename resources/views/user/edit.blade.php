@extends('layouts.dashboard')

@section('container')
    <div class="container mb-5">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/user">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/user">
                        < Kembali ke halaman User</a>
                </div>
                <div>
                </div>
            </div>
            <div class="text-center w-100">
                <i class="bi bi-person-circle fs-1"></i>
            </div>
            <form method="post" action="/user/{{ $user->username }}" enctype="multipart/form-data">
                @method('put')
                @csrf
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
                    <label for="nomor_induk" class="form-label">Nomor Induk</label>
                    <input type="text" class="form-control @error('nomor_induk') is-invalid @enderror" id="nomor_induk"
                        name="nomor_induk" value="{{ old('nomor_induk', $user->nomor_induk) }}">
                    @error('nomor_induk')
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
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <select class="form-select @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
                        <option value="Sekretaris" @selected(old('jabatan', $user->jabatan) == 'Sekretaris')>Sekretaris</option>
                        <option value="Pengurus" @selected(old('jabatan', $user->jabatan) == 'Pengurus')>Pengurus</option>
                        <option value="Pembina" @selected(old('jabatan', $user->jabatan) == 'Pembina')>Pembina</option>
                    </select>
                    @error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="angkatan" class="form-label">Angkatan</label>
                    <input type="number" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan"
                        name="angkatan" value="{{ old('angkatan', $user->angkatan) }}">
                    @error('angkatan')
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
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status1" value="Aktif"
                            @checked(old('status', $user->status))>
                        <label class="form-check-label" for="status">
                            Aktif
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="status2" value="Non Aktif"
                            @checked(old('status', $user->status))>
                        <label class="form-check-label" for="status">
                            Non Aktif
                        </label>
                    </div>
                </div>
                {{-- <div class="mb-3">
            <label for="formFile" class="form-label">Foto</label>
            <input class="form-control" type="file" id="formFile">
          </div> --}}
                <div class="d-flex justify-content-end">
                    <a href="/user" class="btn btn-secondary mx-4">Cancel</a>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
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
