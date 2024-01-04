<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        //checking whehter user is adming 
        // dd(Gate::allows('admin'));//returns true
        // $this->authorize('admin');//returns an object, if falase, abort(403)

        return view('blogs.index', [
            // When you use Blog::with('category')->get(), it retrieves both the Blog records and 
            // their associated Category records in a single query. The with method includes the related data.
            //calls category method from Blog model to get the foregin values
            // 'blogs' => Blog::with(['category', 'author'])->get(),
            
            //fitler() is a scope query method from BLog model which is named as scopeFilter()
            //it will add conditions to the query and return it back
            'blogs' => Blog::latest()
                            ->filter(request(['search', 'category', 'username']))
                            ->paginate(6)//paginate() and simplePaginate()
                            ->withQueryString(), 
        ]);
    }

    public function show(Blog $blog)
    {
        //Route Model Binding
        //In Laravel, when you type-hint an Eloquent model in a route or controller method, 
        //It will automatically retrieve an instance of that model based on the route parameter
        //Blog $blog is the same as Blog::findOrFail($blog)
        return view('blogs.show', [
            'blog' => $blog, //this blog contains the content
            'randomBlogs' => Blog::inRandomOrder()->take(3)->get(), //shuffle Blogs, take the first 3 blogs, execute
        ]);
    }

    public function subscriptionHandler(Blog $blog)
    {   
        
        //check whether the current user has subscribed the blog
        if(auth()->user()->isSubscribed($blog))
        {
            $blog->unSubscribe();
        }else{
            $blog->subscribe();
        }

        return back();
    }

}
