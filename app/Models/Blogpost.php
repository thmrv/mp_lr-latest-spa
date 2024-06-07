<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Meta\Metable;

class Blogpost extends Model
{
    use HasFactory;
    use Metable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'enabled',
        'slug',
        'title',
        'pathname',
        'content',
        'template_name',
        'cover_image_url'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            Metable::attachToFillable();
        });
    }

}
