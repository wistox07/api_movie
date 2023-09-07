<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
        //pruebaita
    }

    public function profile_image(){
        return $this->belongsTo(ProfileImage::class);
    }

    

}
