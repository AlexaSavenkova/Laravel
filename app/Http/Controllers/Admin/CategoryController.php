<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(8);

        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $created = Category::create($request->validated());
        if($created) {

            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.created.success'));
        }
        return back()
            ->with('error',  __('messages.admin.categories.created.error'))
            ->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $updated = $category->fill($request->validated())->save();
        if($updated){

            return redirect()->route('admin.categories.index')
                ->with('success',   __('messages.admin.categories.updated.success'));
        }
        return back()
            ->with('error', __('messages.admin.categories.updated.error'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try{
            $category->delete();
            return response()->json('ok');
        }catch (Exception $e) {
            Log::error('News error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
