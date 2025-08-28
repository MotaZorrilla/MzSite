<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasonicWork extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'document_category_id',
        'file_path',
        'required_degree',
        'is_public',
    ];

    /**
     * Get the category that the work belongs to.
     */
    public function documentCategory()
    {
        return $this->belongsTo(DocumentCategory::class);
    }
}
