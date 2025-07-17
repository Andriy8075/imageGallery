<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageUserLike extends Model
{
    use HasFactory;

    protected $table = 'image_user_likes';
    protected $fillable = [
        'user_id',
        'image_id',
    ];

    public $timestamps = false; // if your pivot table has no timestamps
}
