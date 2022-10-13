<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    public $timestamps = false;

    public function scopeKatekisan($query)
    {
        return $query->where('id_katekisan', \Auth::guard('katekisan')->user()->id)->get();
    }

    /**
     * Get all of the katekisan for the Absensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function katekisan(): hasOne
    {
        return $this->hasOne(Katekisan::class, 'id', 'id_katekisan');
    }
    
}
