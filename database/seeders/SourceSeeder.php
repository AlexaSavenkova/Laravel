<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sources')->insert($this->getData());
    }

    private function getData(): array
    {
        $data =[];
        $faker = Factory::create();
        $data[] = [
            'name' => 'Lenta.ru : Новости',
            'description' => 'Новости, статьи, фотографии, видео. Семь дней в неделю, 24 часа в сутки.',
        ];
        for($i=2; $i<=10; $i++) {

            $data[] = [
                'name' => 'Source '. $i,
                'description' => $faker->text(100),
            ];
        }

        return $data;
    }
}
