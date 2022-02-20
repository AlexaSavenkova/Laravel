<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }
    private function getData(): array
    {
        $data =[];
        $faker = Factory::create();
        for($i=0; $i<10; $i++) {
            $title = $faker->sentence(5);
            $data[] = [
                'title' => $title,
                'link' => $faker->text(100),
                'slug' => Str::slug($title),
                'author' => $faker->userName(),
                'description' => $faker->text(100),
                'source_id' => 1,
            ];
        }

        return $data;
    }
}
