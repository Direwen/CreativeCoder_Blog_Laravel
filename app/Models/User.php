<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    //Accessor methods are to transform an attribute's value before it is accessed for rendering.
    //Naming Convenction of accessor method
    //getColumnNameAttribute, replace "ColumnName" with real column name
    //for name column of user table, getUserAttribute 
    public function getNameAtrribute($value)
    {
        return ucwords($value);//mgmg => Mgmg
    }

    public function getUsernameAttribute($value)
    {
        return ucwords($value); 
    }

    //Mutator methods are to transform an attribute's value before it is stored in the database
    //Naming Convention of mutator method
    //set{AttributeName}Attribute ~ setPasswordAttribute for password column
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    //Many to Many table
    public function subscribedBlogs()
    {
        // will return the blogs which this current user subscribed
        return $this->belongsToMany(Blog::class);
    }

    //scope query method
    public function isSubscribed($blog)
    {   
        return auth()->user()->subscribedBlogs && auth()->user()->subscribedBlogs->contains('id', $blog->id);
    }
}
