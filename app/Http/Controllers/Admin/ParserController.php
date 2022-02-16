<?php

declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Contracts\Parser;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ParserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Parser $service)
    {
//        $urls = ['https://news.yandex.ru/music.rss', 'https://news.yandex.ru/games.rss'];

        $url = 'https://lenta.ru/rss';
        $data = $service->setLink($url)->parse();

      // пока сделала очистку таблиц, чтобы при повторном париснге новости не дублировались
      // потом придумаю метод получше

        Schema::table('categories_has_news', function (Blueprint $table) {
            $table->DropForeign('categories_has_news_news_id_foreign');
        });

        \DB::table('categories_has_news')->truncate();
        \DB::table('news')->truncate();

        Schema::table('categories_has_news', function (Blueprint $table) {

            $table->foreign('news_id')
                ->references('id')
                ->on('news');
        });


          $error = false;
        foreach ($data['news'] as $news){
            // Получить катергоию по `name` или создать её с атрибутами name description и slug
            $category = Category::firstOrCreate(
                ['name' => $news['category']],
                ['slug' => Str::slug($news['category']), 'description' => 'Все новости на тему: '.$news['category']]
            );
            $news = $news + ['slug' => Str::slug($news['title']), 'source_id' => 1];
            $created = News::create($news);
            if($created) {
                $created->categories()->attach($category);
            } else {
                $error = true;
            }
        }
        if($error){
            return redirect()->route('admin.index')
                ->with('error', __('messages.admin.parser.error'));
        }else {
            return redirect()->route('admin.index')
                ->with('success', __('messages.admin.parser.success'));
        }

    }
}
