@extends('layouts.dashboard')

@section('container')
    <div class="container">
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="/agenda">Agenda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </nav>
        </div>
        <div class="row bg-white mt-4 pt-3 p-1 rounded-3 shadow-sm">
            <div class="d-flex justify-content-between">
                <div>
                    <a href="/agenda">
                        < Kembali ke halaman Agenda</a>
                </div>
                @if (auth()->user()->jabatan === 'Sekretaris')
                    <div class="mb-3">
                        <a href="/agenda/{{ $agenda->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil">
                                Edit</i></a>
                        <form action="/agenda/{{ $agenda->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?')"><i
                                    class="bi bi-trash"></i> Delete</button>
                        </form>
                    </div>
                @else
                @endif
            </div>
            <h3 class="" style="background-color: {{ $agenda->latar }}; color: {{ $agenda->text }}">
                {{ $title }}</h3>
            <table class="m-3" style="width: 300px">
                <tr>
                    <th>Tanggal</th>
                    <td>:</td>
                    <td>{{ $agenda->task_date }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $agenda->name }}</td>
                </tr>
                <tr>
                    <th>Target</th>
                    <td>:</td>
                    <td>{{ $agenda->description }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
