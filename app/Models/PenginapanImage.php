<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenginapanImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the penginapan that owns the PenginapanImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penginapan()
    {
        return $this->belongsTo(Penginapan::class, 'penginapan_id', 'id');
    }
}
