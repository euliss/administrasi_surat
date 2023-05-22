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
                    <a href="/user/{{ $user->username }}/edit" class="btn btn-warning"><i class="bi bi-pencil">
                            Edit</i></a>
                    <form action="/user/{{ $user->username }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i
                                class="bi bi-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
            <div class="text-center">
                @if ($user->image)
                    <img src="{{ asset('/storage/' . $user->image) }}" alt="Foto Profil {{ $user->name }}"
                        class="w-25">
                @else
                    <i class="bi bi-person-circle fs-1 w-25"></i>
                @endif
            </div>
            <div class="d-flex justify-content-center">
                <table class="m-3" style="width: 300px">
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Induk</th>
                        <td>:</td>
                        <td>{{ $user->nomor_induk }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>:</td>
                        <td>{{ $user->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>:</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>:</td>
                        <td>{{ $user->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>:</td>
                        <td>{{ $user->status }}</td>
                    </tr>
                    <tr>
                        <th>Angkatan</th>
                        <td>:</td>
                        <td>{{ $user->angkatan }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
