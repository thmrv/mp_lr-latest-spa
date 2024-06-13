<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Meta\Metable;
use Spatie\Translatable\HasTranslations;

class Blogpost extends Model
{
    use HasFactory;
    use Metable;
    use HasTranslations;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->initializeMetable();
    }

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

    public $translatable = ['title', 'description', 'content'];

}
