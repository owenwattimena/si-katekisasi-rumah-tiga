<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PilihanJawaban extends Model
{
    use HasFactory;
    protected $table = "pilihan_jawaban_berganda";
    public $timestamps = false;

    /**
     * Get the soal that owns the PilihanJawaban
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function soal(): BelongsTo
    {
        return $this->belongsTo(Soal::class, 'id_soal', 'id');
    }
}
