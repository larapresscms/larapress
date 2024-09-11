<?php

namespace LaraPressCMS\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'position',
        'category_id',
        'title',
        'slug',
        'content',
        'content_css',
        'excerpt',
        'thumbnail_path',
        'post_type',
        'status',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'more_option_1',
        'more_option_2',
        'gallery_img',
        'trash',
        'template'
    ];
}
