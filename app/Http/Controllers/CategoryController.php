<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = new Category();
        $categories = $categories->getCategories();
        return view('news.categories', ['categoryList' => $categories]);
    }

    public function show($slug)
    {
        $category = new Category();
        $newsByCategory = $category->getNewsByCategorySlug($slug);
        $categoryName = $category->getCategoryNameBySlug($slug);
        return view('news.category', ['categoryName'=> $categoryName, 'newsList' => $newsByCategory]);
    }
}
