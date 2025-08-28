<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_category_id',
        'file_path',
    ];

    /**
     * Get the category that the image belongs to.
     */
    public function imageCategory()
    {
        return $this->belongsTo(ImageCategory::class);
    }
}