<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData(): array
    {
        $faker = Factory::create();
        $data = [
            [
                'id' => 1,
                'name' =>  'Политика',
                'slug' => 'politics',
                'description' => $faker->text(100),
            ],
            [
                'id' => 2,
                'name' =>  'Экономика',
                'slug' => 'economics',
                'description' => $faker->text(100),
            ],
            [
                'id' => 3,
                'name' =>  'Общество',
                'slug' => 'society',
                'description' => $faker->text(100),
            ],
            [
                'id' => 4,
                'name' =>  'Культура',
                'slug' => 'culture',
                'description' => $faker->text(100),
            ],
            [
                'id' => 5,
                'name' =>  'Спорт',
                'slug' => 'sport',
                'description' => $faker->text(100),
            ],
            [
                'id' => 6,
                'name' =>  'IT',
                'slug' => 'it',
                'description' => $faker->text(100),
            ],
            [
                'id' => 7,
                'name' =>  'В мире',
                'slug' => 'world',
                'description' => $faker->text(100),
            ],
            [
                'id' => 8,
                'name' =>  'Наука',
                'slug' => 'science',
                'description' => $faker->text(100),
            ],
            [
                'id' => 9,
                'name' =>  'Кино',
                'slug' => 'cinema',
                'description' => $faker->text(100),
            ],
            [
                'id' => 10,
                'name' =>  'Путешествия',
                'slug' => 'travel',
                'description' => $faker->text(100),
            ],
        ];
        return $data;
    }
}
