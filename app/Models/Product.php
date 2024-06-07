<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Meta\Metable;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Metable;

    protected $contentColumn = 'content';

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'title',
        'description',
        'slug',
        'pathname',
        'content',
        'template_name',
        'cover_image_url',
        'custom_page_name'
    ];

    protected $guarded = ['id'];
 
    public $translatable = ['title', 'description', 'content'];

    public static function booted()
    {
        static::creating(function ($model) {
            Metable::attachToFillable();
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
        ];
    }
}
