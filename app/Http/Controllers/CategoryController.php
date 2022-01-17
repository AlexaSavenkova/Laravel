<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = $this->getCategories();
        return view('news.categories', ['categoryList' => $categories]);
    }

    public function show($slug)
    {
        $news = $this->getNews();
        $newsByCategory = array_filter($news, fn($arr) => $arr['category_slug'] === $slug);
        $categoryName = $this->getCategoryNameBySlug($slug);
        return view('news.category', ['categoryName'=> $categoryName, 'newsList' => $newsByCategory]);
    }
}
