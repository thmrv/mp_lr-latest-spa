<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Meta\Metable;
use Spatie\Translatable\HasTranslations;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class Page extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Metable;
    //use HasFilamentComments;
    use HasTranslations;

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
 
    protected $guarded = ['id'];
 
    public $translatable = ['title', 'description', 'content'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];
    
    public static function booted()
    {
        static::creating(function ($model) {
            Metable::attachToFillable();
        });
    }

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
