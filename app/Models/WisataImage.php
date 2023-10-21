<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the image that owns the WisataImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id', 'id');
    }
}
