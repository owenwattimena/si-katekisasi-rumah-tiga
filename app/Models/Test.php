<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasFactory;

    protected $table = 'tes';

    public $timestamps =false;

    /**
     * Get all of the jawaban for the Test
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jawaban(): HasMany
    {
        return $this->hasMany(Jawaban::class, 'id_tes', 'id');
    }
}
