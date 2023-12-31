<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the wisata that owns the WisataInfo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id', 'id');
    }
}
