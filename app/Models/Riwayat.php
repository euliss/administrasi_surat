<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Riwayat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public static function notif()
    {
        if (auth()->user()->jabatan == 'Pembina') {
            $notif = DB::table('riwayats')->where([
                ['jenis', '=', 'Surat Keluar'],
                ['status', '=', 'Tindaklanjuti']
            ])->latest()->get();
        } elseif (auth()->user()->jabatan == 'Sekretaris') {
            $notif = DB::table('riwayats')->where([
                ['jenis', '=', 'Pengajuan'],
                ['status', '=', 'menunggu'],
            ])->orWhere([
                ['jenis', '=', 'Surat Keluar'],
                ['status', '=', 'Disetujui']
            ])->latest()->get();
        } else {
            $notif = DB::table('riwayats')->where([
                ['nama', '=', auth()->user()->name],
                ['pembuat_id', '=', auth()->user()->id],
                ['jenis', '=', 'Pengajuan'],
                ['status', '=', 'Tindaklanjuti']
            ])->latest()->get();
        }
        return $notif;
    }
}
