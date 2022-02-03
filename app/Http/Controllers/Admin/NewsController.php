<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with('categories')
            ->with('source')
            ->paginate(10);
        return view('admin.news.index', [
            'newsList' => $news,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $sources = Source::all();
        return view('admin.news.create', [
            'categories' => $categories,
            'sources' => $sources,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);
        $data = $request->only(['title', 'author', 'status','description','source_id']) + [
            'slug' => Str::slug($request->input('title'))
        ];
        $created = News::create($data);
        if($created) {
            $created->categories()->attach($request->input('categories'));
//            foreach ($request->input('categories') as $category) {
//                DB::table('categories_has_news')
//                    ->insert([
//                       'news_id' => $created->id,
//                       'category_id' => intval($category),
//                    ]);
//            }
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }
        return back()
            ->with('error', 'Не удалось добавить запись')
            ->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $categories = Category::all();
        $sources = Source::all();
        $selectCategories = DB::table('categories_has_news')
            ->where('news_id', $news->id)
            ->get()
            ->map(fn($item) => $item->category_id)
            ->toArray();

        $selectSource = $news->source_id;

        return view('admin.news.edit', [
            'news' => $news,
            'categories' => $categories,
            'selectCategories' => $selectCategories,
            'sources' => $sources,
            'selectSource' => $selectSource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:5']
        ]);
        $data = $request->only(['title', 'author', 'status','description', 'source_id']) + [
                'slug' => Str::slug($request->input('title'))
        ];
        $updated = $news->fill($data)->save();
        if($updated){
            $news->categories()->detach();
            $news->categories()->attach($request->input('categories'));

            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно обновлена');
        }
        return back()
            ->with('error', 'Не удалось обновить запись')
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
