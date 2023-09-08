<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    
    public function ageCategory()
    {
        return $this->belongsTo(AgeCategory::class);
    }

    public function movieImages(){
        return $this->hasMany(MovieImage::class);

    }
    
}
