<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'file_path', 'user_id'];

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'image_user_likes')
            ->withTimestamps();
    }


}

