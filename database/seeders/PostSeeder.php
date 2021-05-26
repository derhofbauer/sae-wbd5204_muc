<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();

        $posts = Post::factory(10)->make();
        foreach ($posts as $post) {
            $post->user_id = $user->random(1)->first()->id;
            $post->save();
        }
    }
}
