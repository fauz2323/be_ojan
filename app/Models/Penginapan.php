<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the admin that owns the Wisata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the image associated with the Penginapan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(PenginapanImage::class, 'penginapan_id', 'id');
    }
}
