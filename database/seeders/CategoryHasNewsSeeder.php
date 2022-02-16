<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryHasNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories_has_news')->insert($this->getData());
    }

    private function getData(): array
    {
        $data =[];

        for($i=1; $i<=10; $i++) { // в NewsSeeder 10 новостей, каждая новость должна принадлежать как минимум к  1 категории
            $news_id = $i;
            $num = rand(1,3); // каждая новость может иметь от 1 до 3 категорий
            for ($j=1; $j<=$num; $j++){
                $data[] = [
                    'news_id' => $news_id,
                    'category_id' => rand(1,3),
                ];
            }
        }
        $data = array_unique($data, SORT_REGULAR); // удаляем дубликаты news_is - category_id
        return $data;
    }
}
