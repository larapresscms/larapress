<?php

namespace LaraPressCMS\LaraPress\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    use HasFactory;
    protected $fillable = ['fname','fsubject','femail','fphone','fmessage','fattachemnt'];
}
