<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Post;
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 15; $i++)
        {
            $post = new Post();
            $post->titolo = $faker->sentence(5);
            $post->contenuto = $faker->text(250);
            $post->slug = Str::slug($post->titolo);
            $post->save();
        }
    }
}
