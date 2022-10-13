<?php

namespace App\Models;

use App\Models\User;
use App\Models\Absensi;
use App\Models\Periode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    public $timestamps = false;

    /**
     * Get the pengajar associated with the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pengajar(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'id_pengajar');
    }

    /**
     * Get the periode associated with the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function periode(): HasOne
    {
        return $this->hasOne(Periode::class, 'id', 'id_periode');
    }

    /**
     * Get all of the absensi for the Jadwal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function absensi(): HasMany
    {
        return $this->hasMany(Absensi::class, 'id_jadwal', 'id');
    }
    
}
