<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Agenda;
use App\Models\Absensi;
use App\Models\Riwayat;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use App\Models\DokumenLainnya;

class ArsipController extends Controller
{
    public function index()
    {
        return view('v_arsip', [
            'title' => 'Arsip',
            'suratmasuk' => SuratMasuk::count(),
            'suratkeluar' => SuratKeluar::where('status', 'disetujui')->count(),
            'dokumen' => DokumenLainnya::count(),
            'absensi' => Absensi::count(),
            'agenda' => Agenda::all(),
            'notif_permohonan' => SuratKeluar::where('status', 'menunggu')->count(),
            'tasks' => Task::all(),
            'notif' => Riwayat::notif()
        ]);
    }
}
