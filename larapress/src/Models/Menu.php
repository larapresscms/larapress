<?php

namespace LaraPressCMS\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','category_id','sub_menu_id','title','status','url','target','position'];

} 