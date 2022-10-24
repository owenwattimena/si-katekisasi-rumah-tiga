<?php

namespace App\Models;

use App\Models\PilihanJawaban;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Soal extends Model
{
    use HasFactory;

    protected $table = "soal";

    public $timestamps = false;

    /**
     * Get all of the pilihan for the Soal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pilihan(): HasMany
    {
        return $this->hasMany(PilihanJawaban::class, 'id_soal', 'id');
    }

    /**
     * Get the jawaban associated with the Soal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jawaban(): HasOne
    {
        return $this->hasOne(PilihanJawaban::class, 'id_soal', 'id');
    }
}
