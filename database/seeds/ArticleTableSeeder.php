<?php

use App\Models\Article;
use App\Models\Author;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * @var \Faker\Generator
     */
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::unguard();
        if (!empty(Article::first())) {
            return;
        }
        $authors = Author::all();
        $users = User::all();
        $articlesData = [];
        for ($i = 0; $i < 100; $i++) {
            $articlesData[] = [
                'title'     => $this->faker->sentence(rand(3, 6)),
                'body'      => $this->faker->paragraph(rand(3, 6)),
                'user_id'   => $users->random()->id,
                'author_id' => $authors->random()->id,
            ];
        }
        Article::insert($articlesData);
    }
}
