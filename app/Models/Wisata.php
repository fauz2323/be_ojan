<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
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
     * Get the kategori that owns the Wisata
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kategori()
    {
        return $this->belongsTo(WisataCategory::class, 'wisata_category_id', 'id');
    }

    /**
     * Get the image associated with the Wisata
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasOne(WisataImage::class, 'wisata_id', 'id');
    }

    /**
     * Get the info associated with the Wisata
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(WisataInfo::class, 'wisata_id', 'id');
    }
}
