<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            DB::table('books')->insert([
                'title' => $faker->sentence,
                'author' => $faker->name,
                'isbn' => $faker->isbn13,
                'genre' => $faker->word,
                'image' => $faker->imageUrl(),
                'published' => $faker->date,
                'publisher' => $faker->company,
                'publication_description' => $faker->paragraph,
                'date' => $faker->date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
