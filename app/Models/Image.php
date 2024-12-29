<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $startCountOfImages = 300;
    protected $fillable = ['url'];
}

