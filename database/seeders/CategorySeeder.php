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
                'slug' => 'politika',
                'description' => $faker->text(100),
            ],
            [
                'id' => 2,
                'name' =>  'Экономика',
                'slug' => 'ekonomika',
                'description' => $faker->text(100),
            ],
            [
                'id' => 3,
                'name' =>  'Спорт',
                'slug' => 'sport',
                'description' => $faker->text(100),
            ],
        ];
        return $data;
    }
}
