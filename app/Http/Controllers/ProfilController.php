<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Riwayat;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        return view('v_profil', [
            'title' => 'Profil',
            'user' => User::find(Auth()->user()->id),
            'notif_permohonan' => SuratKeluar::where('status', 'menunggu')->count(),
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }
}
