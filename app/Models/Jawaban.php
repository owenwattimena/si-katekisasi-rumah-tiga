<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban';
    public $timestamps = false;

    /**
     * Get the katekisan that owns the Jawaban
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function katekisan(): BelongsTo
    {
        return $this->belongsTo(Katekisan::class, 'id_katekisan', 'id');
    }

    /**
     * Get all of the detailBerganda for the Jawaban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailJawabanBerganda(): HasMany
    {
        return $this->hasMany(DetailJawabanBerganda::class, 'id_jawaban', 'id');
    }
    /**
     * Get all of the detailBerganda for the Jawaban
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailJawabanEssay(): HasMany
    {
        return $this->hasMany(DetailJawabanEssay::class, 'id_jawaban', 'id');
    }
}
