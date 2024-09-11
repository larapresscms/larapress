<?php

namespace LaraPressCMS\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posttype extends Model
{
    use HasFactory;

   protected $fillable = [
       'user_id',
       'category_main_id',
       'name',
       'slug',
       'status',
       'category_id',
       'title',
       'content', 
       'excerpt',
       'thumbnail_path', 
       'option_1',
       'option_2',
       'option_3',
       'option_4',
       'more_option_1',
       'more_option_2',
       'gallery_img',
       'trash',       
       'in_menu_swh', 
       'menu_icon',
       'in_dashboard',
       'pt_content',
       'pt_content_css',
       'pt_thumbnail_path',
       'paginate',
       'template'

    ];
}
