<?php

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
        factory(App\User::class, 5)->create()->each(function($user) {
            $posts = factory(App\Post::class, 4)->make();
            $user->posts()->saveMany($posts);
       });       
    }
}
