<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'source',
    ];

    /**
     * Get the category that the work belongs to.
     */
    public function documentCategory(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'document_category_id');
    }

    /**
     * Get the degree that the work belongs to.
     */
    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class, 'required_degree');
    }
}