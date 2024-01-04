<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'intro', 'body'];

    //Eloquent will automatically include those relationships in the query results
    protected $with = ['category', 'author'];

    //scope query method, will be called as filter()
    //first param is the current query which is default
    //second param is the data which will be passed manually 
    public function scopeFilter($query, $filter)
    {   
        // $query argument is the same as $query
        //$search takes the value of request('search') if true 
        return $query
        ->when($filter['search'] ?? false, function($query, $search){
            //logical query grouping
            // (`title` LIKE '%ming%' or `body` LIKE '%ming%') and `title` = 'frontend'
            $query->where(function($query) use ($search){
                $query
                ->where('title', 'LIKE', '%' . $search . '%')
                ->orwhere('body', 'LIKE', '%' . $search . '%');
            });
        })
        ->when($filter['category'] ?? false, function($query, $slug){
            //wherehas filters the main model based on the existence of related models that match the specified conditions
            //category refers to the realtionship method
            $query->wherehas('category', function($query) use ($slug) {
                $query->where('slug', $slug);
            });
        })
        ->when($filter['username'] ?? false, function($query, $username){
            $query->wherehas('author', function($query) use ($username){
                $query->where('username', $username);
            });
        });
    }

    //by default, Laravel will find category_id in Blog table according to this rs method name : category() 
    public function category()
    {
        return $this->belongsTo(Category::class);    
    }

    //to override, a foreign key must be defined as the second argument and method name can be anything
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //FOR BLOG_USER TABLE (MANY TO MANY RELATIONSHIP)
    public function subscribers()
    {
        // will return subscribers who subscribed the current blog
        return $this->belongsToMany(User::class);
    }

    public function unSubscribe()
    {
        //detach will remove the record which have this blog id and the other id passed in detach()
        $this->subscribers()->detach(auth()->id());
    }

    public function subscribe()
    {
        //detach will add the record which have this blog id and the other id passed in attach()
        $this->subscribers()->attach(auth()->id());
    }
}
