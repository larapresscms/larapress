<?php

namespace LaraPressVendor\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

   protected $fillable = ['img_name'];
}
