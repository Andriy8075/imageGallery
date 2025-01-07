<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Description;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'file_path', 'user_id'];
}

