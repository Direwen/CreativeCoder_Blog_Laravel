<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // to delete data from table manually
        // Blog::truncate();

        //for admin creds
        $adminUser = ['name' => 'Bot 1', 'username' => 'Bot 1', 'is_admin' => true, 'email' => 'bot1@gmail.com', 'password' => 'testingbot1'];
        User::create($adminUser);
        //to override the value of the fake data
        // Blog::factory()->create(['title'=> 'Overriden Name']);
        $user1 = User::factory()->create(['name'=> 'mg mg', 'username'=> 'mgmg']);
        $user2 = User::factory()->create(['name'=> 'aung aung', 'username'=> 'aungaung']);
        $frontend = Category::factory()->create(['name' => 'frontend', 'slug'=> 'frontend']);
        $backend = Category::factory()->create(['name' => 'backend', 'slug'=> 'backend']);

        Blog::factory()->create(['category_id' => $frontend -> id, 'user_id'=> $user1->id]);
        Blog::factory()->create(['category_id' => $backend -> id, 'user_id'=> $user2->id]);
        // Blog::factory(4)->create(['user_id' => $user1->id]);
        Comment::factory()->create(['blog_id'=> 1, 'user_id'=> $user1->id]);
        Comment::factory()->create(['blog_id'=> 1, 'user_id'=> $user2->id]);
        Comment::factory(3)->create(['blog_id'=> 1]);
    }
}
