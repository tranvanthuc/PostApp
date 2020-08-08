<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => 'Laravel'],
            ['name' => 'PHP'],
            ['name' => 'ReactJS'],
            ['name' => 'VueJS'],
            ['name' => 'Java'],
            ['name' => 'NodeJS'],
        ];

        Tag::insert($tags);

        $postTag = [
            ['post_id' => 1, 'tag_id' => 1],
            ['post_id' => 1, 'tag_id' => 2],
            ['post_id' => 1, 'tag_id' => 3],
            ['post_id' => 2, 'tag_id' => 4],
            ['post_id' => 2, 'tag_id' => 5],
            ['post_id' => 2, 'tag_id' => 6],
            ['post_id' => 3, 'tag_id' => 1],
            ['post_id' => 4, 'tag_id' => 1],
            ['post_id' => 5, 'tag_id' => 2],
            ['post_id' => 6, 'tag_id' => 1],
        ];


        DB::table('post_tag')->insert($postTag);
    }
}
