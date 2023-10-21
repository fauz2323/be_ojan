<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFavorite extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the userApp that owns the UserFavorite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userApp()
    {
        return $this->belongsTo(UserAplikasi::class, 'user_app_id', 'id');
    }

    /**
     * Get the wisata that owns the UserFavorite
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id', 'id');
    }
}
