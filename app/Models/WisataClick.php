<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataClick extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the wisata that owns the WisataClick
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id', 'id');
    }
}
