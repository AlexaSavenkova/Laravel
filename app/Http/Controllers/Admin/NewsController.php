<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\CreateRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Models\Category;
use App\Models\News;
use App\Models\Source;
use App\Services\UploadService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;


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
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $created = News::create($request->validated());
        if($created) {
            $created->categories()->attach($request->input('categories'));
            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.created.success'));
        }
        return back()
            ->with('error', __('messages.admin.news.created.error'))
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
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
     * @param UpdateRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, News $news)
    {
        $validated = $request->validated();
        if($request->hasFile('image')) {
            $validated['image'] = app(UploadService::class)
                ->saveFile($request->file('image'));
        }

        $updated = $news->fill($validated)->save();

        if($updated){
            $news->categories()->detach();
            $news->categories()->attach($request->input('categories'));

            return redirect()->route('admin.news.index')
                ->with('success', __('messages.admin.news.updated.success'));
        }
        return back()
            ->with('error', __('messages.admin.news.updated.eror'))
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
        try{
            $news->delete();
            return response()->json('ok');
        }catch (Exception $e) {
            Log::error('News error destroy', [$e]);
            return response()->json('error', 400);
        }

    }
}
