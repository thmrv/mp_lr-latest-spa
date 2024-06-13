<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Meta\Metable;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Metable;
    use HasTranslations;

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
        'custom_page_name',
        'page_name'
    ];

    //protected $guarded = ['id'];

    public $translatable = ['title', 'description', 'content'];

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->initializeMetable();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [];
    }
}
