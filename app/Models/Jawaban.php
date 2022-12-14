<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawaban_tes';
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
}
