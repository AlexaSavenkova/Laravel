<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $categories = [
        [
            'id' => 1,
            'name' =>  'Политика',
            'slug' => 'politics'
        ],
        [
            'id' => 2,
            'name' =>  'Экономика',
            'slug' => 'economics'
        ],
        [
            'id' => 3,
            'name' =>  'Общество',
            'slug' => 'society'
        ],
        [
            'id' => 4,
            'name' =>  'Культура',
            'slug' => 'culture'
        ],
        [
            'id' => 5,
            'name' =>  'Спорт',
            'slug' => 'sport'
        ],
    ];

    public function getCategories()
    {
        return $this->categories;
    }

    public function getCategoryNameById($id)
    {
        $categories = $this->getCategories();
        $key = array_search($id, array_column($categories, 'id'));
        return $categories[$key]['name'];
    }

    public function getCategoryNameBySlug($slug)
    {
        $categories = $this->getCategories();
        $key = array_search($slug, array_column($categories, 'slug'));
        return $categories[$key]['name'];
    }

    public function getCategorySlugById($id)
    {
        $categories = $this->getCategories();
        $key = array_search($id, array_column($categories, 'id'));
        return $categories[$key]['slug'];
    }

    public function getNews(?int $id = null): array
    {
        $faker = Factory::create();

        if($id) {
            $category_id = rand(1,5);
            return [
                'id' => $id,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow'),
                'category_id'=> $category_id,
                'category'=>$this->getCategoryNameById($category_id),
                'category_slug'=>$this->getCategorySlugById($category_id),
            ];
        }

        $data = [];
        for($i=1; $i<=10; $i++){
            $category_id = rand(1,5);
            $data[] = [
                'id' => $i,
                'title' => $faker->jobTitle(),
                'description' => $faker->text(100),
                'author' => $faker->userName(),
                'created_at' => now('Europe/Moscow'),
                'category_id'=> $category_id,
                'category'=>$this->getCategoryNameById($category_id),
                'category_slug'=>$this->getCategorySlugById($category_id),
            ];
        }

        return $data;
    }
}
