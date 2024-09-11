<?php

namespace LaraPressCMS\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['site_title','sub_title','fav_icon','site_logo','dashboard_color','text_color','text_hover','theme_url','home_url','editor','header','footer'];
}
