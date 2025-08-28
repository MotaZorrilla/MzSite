<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the gallery images for the image category.
     */
    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }
}