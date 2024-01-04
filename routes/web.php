<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



Route::get('/', [BlogController::class, 'index']);

//{blog} = wild card concept, $blog takes the value of that
//blog:slug will find the value from the slug field
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->where('blog', '[A-z\d\-_]+');
Route::post('/blogs/{blog:slug}/comments', [CommentController::class, 'store']);

Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/login', [AuthController::class, 'post_login'])->middleware('guest');

Route::post('/blogs/{blog:slug}/subscription', [BlogController::class, 'subscriptionHandler']);

//Admin route
// Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->middleware('can:admin');
// Route::post('/admin/blogs/store', [AdminBlogController::class, 'store'])->middleware('can:admin');
// Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destroy'])->middleware('can:admin');
// Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->middleware('can:admin');
// Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit'])->middleware('can:admin');
// Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update'])->middleware('can:admin');

//Route Group
Route::middleware('can:admin')->group(function () {
        Route::get('/admin/blogs', [AdminBlogController::class, 'index']);
        Route::post('/admin/blogs/store', [AdminBlogController::class, 'store']);
        Route::delete('/admin/blogs/{blog:slug}/delete', [AdminBlogController::class, 'destroy']);
        Route::get('/admin/blogs/create', [AdminBlogController::class, 'create']);
        Route::get('/admin/blogs/{blog:slug}/edit', [AdminBlogController::class, 'edit']);
        Route::patch('/admin/blogs/{blog:slug}/update', [AdminBlogController::class, 'update']);
});

// Route::get('/users/{user:username}', function (User $user) {
//     return view('blogs', [
        //this will cause N + 1 probelm running the same query for several times 
        //but $with is modified in Blog model, so no N + 1 problem rn
        // 'blogs' => $user->blogs,

        //these lazy or eager laoding will solve it
        //Method 1 : $user-blogs() will return the relationship (query builder) instance instead of results
        //the with function will apply eager loading during the query building process
        // 'blogs' => $user->blogs()->with('category', 'author')->get(),

        //Method 2 : $user-blogs will return a collection of blogs and 
        // the load will apply eager loading to those records without issuing additional queries to the database
        // 'blogs' => $user->blogs->load('category', 'author'),

//     ]);
// });
