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
        for($i=1; $i<=10; $i++) {

            $data[] = [
                'name' => 'Source '. $i,
                'description' => $faker->text(100),
            ];
        }

        return $data;
    }
}
