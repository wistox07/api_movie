<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMovieImage extends Model
{
    use HasFactory;

    public function movieImages(){
        return $this->hasMany(MovieImage::class);
    }
}
