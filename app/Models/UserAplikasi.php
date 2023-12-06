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
    protected $hidden = [
        'password',
    ];
}
