<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminBlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'blogs' => Blog::latest()->paginate(6),
        ]);
    }

    public function create()
    {   
        return view('admin.blogs.create', [
            'categories' => Category::all(),
        ]);
    }
    public function store()
    {
        //will store images in 2 storage folders (storage:link)
        //public/storage/thumbnails (web direct assets) 
        //storage/app/public/thumbnails (for development)
        //returns the stored image path
        $path = request()->file('thumbnail')->store('thumbnails');
        //validate inputs
        $formData = request()->validate([
            'title'=> ['required'],
            'slug'=> ['required', Rule::unique('blogs', 'slug')],
            'intro'=> ['required'],
            'body'=> ['required'],
            'category_id'=> ['required', Rule::exists('categories', 'id')],
        ]);
        //add current logged-in user id
        $formData["user_id"] = auth()->id();
        //add the image file path
        $formData["thumbnail"] = $path;
        //Create a record in blog table
        Blog::create($formData);
        //Redirect user back to home page
        return redirect('/');
    }

    public function destroy(Blog $blog)
    {
        //delete the record from the table
        $blog->delete();
        //redirect back
        return back();

    }

    public function edit(Blog $blog)
    {   
        return view('admin.blogs.edit', [
            'blog' => $blog,
            'categories' => Category::all(),
        ]);
    }

    public function update(Blog $blog)
    {
        
        //returns the stored image path
        $path = request()->file('thumbnail') ? request()->file('thumbnail')->store('thumbnails') : $blog->thumbnail;
        //validate inputs
        $formData = request()->validate([
            'title'=> ['required'],
            'slug'=> ['required', Rule::unique('blogs', 'slug')->ignore($blog->id)],
            'intro'=> ['required'],
            'body'=> ['required'],
            'category_id'=> ['required', Rule::exists('categories', 'id')],
        ]);
        //add current logged-in user id
        $formData["user_id"] = auth()->id();
        //add the image file path
        $formData["thumbnail"] = $path;
        //Update the record
        $blog->update($formData);
        //Redirect user back to home page
        return redirect('/');
    }
}
