<?php

namespace App\Models;

use App\Models\AbsensiDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function absensiDetail()
    {
        return $this->hasMany(AbsensiDetail::class);
    }
}
