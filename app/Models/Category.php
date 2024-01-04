<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function blogs()
    {
        //Blog:class return a namespace of the class
        //class is the constant
        return $this->hasMany(Blog::class);
    }
}
