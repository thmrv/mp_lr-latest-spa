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
        'content_json',
        'content_html',
        'template_name',
        'cover_image_url'
    ];
 
    //protected $guarded = ['id'];
 
    public $translatable = ['title', 'description', 'content_json', 'content_html'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];
    
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $this->initializeMetable();
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
