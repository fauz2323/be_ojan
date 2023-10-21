<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisataCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the user that owns the WisataCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the wisata for the WisataCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wisata()
    {
        return $this->hasMany(Wisata::class, 'wisata_category_id', 'id');
    }
}
