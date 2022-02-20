<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {

       $news = News::select(News::$availableFields)->orderBy('created_at', 'desc')->get();
       return view('news.index', [
            'newsList' => $news
        ]);

    }

    public function show(News $news)
    {
        return view('news.show', [
            'news' => $news
        ]);
    }
}
