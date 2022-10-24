<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailJawabanBerganda extends Model
{
    use HasFactory;
    protected $table = 'detail_jawaban_tes_berganda';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_jawaban',
        'id_soal',
        'id_pilihan_jawaban',
    ];

    /**
     * Get the pilihanJawaban associated with the DetailJawabanBerganda
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function pilihanJawaban(): HasOne
    {
        return $this->hasOne(PilihanJawaban::class, 'id', 'id_pilihan_jawaban');
    }
}
