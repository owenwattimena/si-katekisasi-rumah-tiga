<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Katekisan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "katekisan";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'password',
        'nama_lengkap',
        'nama_panggilan',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'anak_ke',
        'unit',
        'sektor',
        'tahun_baptis',
        'pendidikan',
        'status',
        'telp_hp',
        'nama_ayah',
        'pekerjaan_ayah',
        'unit_ayah',
        'sektor_ayah',
        'telp_hp_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'unit_ibu',
        'sektor_ibu',
        'telp_hp_ibu',
        'nama_wali',
        'pekerjaan_wali',
        'unit_wali',
        'sektor_wali',
        'telp_hp_wali'
    ];

    function scopeShowLess($query)
    {   
        return $query->get();
    }
}
