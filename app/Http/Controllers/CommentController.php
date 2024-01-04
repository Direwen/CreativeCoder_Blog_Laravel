<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        $comment = request()->validate([
            'body'=> ['required', 'min:10'],
        ]);

        //store comment
        $blog->comments()->create([
            'body'=> request('body'),
            'user_id'=> auth()->user()->id,
        ]);

        //mailing to the subscribers of this blog except the current user
        $subscribers = $blog->subscribers->filter(fn ($subscriber) => $subscriber->id != auth()->id());
        $subscribers->each(function($subscriber) use ($blog){
            //Step 1 -> changed queue connection database connection
            //Step 2 -> ran queue:table and migrated jobs migration table
            //Step 3 -> Queue function will put all these tasks into jobs table
            //Step 4 -> run queue:work to run every record in jobs table until it's done    
            Mail::to($subscriber->email)->queue(new SubscriberMail($blog));
        });
    
        return redirect('/blogs/'.$blog->slug);
    }
}
