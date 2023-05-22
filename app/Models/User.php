<?php

namespace App\Models;

use App\Models\Arsip;
use App\Models\Agenda;
use App\Models\Absensi;
use App\Models\Pengajuan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use App\Models\AbsensiDetail;
use App\Models\DokumenLainnya;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function arsip()
    {
        return $this->hasMany(Arsip::class);
    }

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }

    public function suratKeluar()
    {
        return $this->hasMany(SuratKeluar::class);
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function dokumenLainnya()
    {
        return $this->hasMany(DokumenLainnya::class);
    }

    public function agenda()
    {
        return $this->hasMany(Agenda::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function absensiDetail()
    {
        return $this->hasMany(AbsensiDetail::class);
    }

    public function getRouteKeyName()
    {
        return 'username';
    }
}
