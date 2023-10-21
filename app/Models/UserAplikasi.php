<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class UserAplikasi extends Model
{
    use HasFactory, HasApiTokens;

    protected $guarded = [];

    /**
     * Get all of the favorite for the UserAplikasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorite(): HasMany
    {
        return $this->hasMany(UserFavorite::class, 'user_aplikasi_id', 'id');
    }
}
