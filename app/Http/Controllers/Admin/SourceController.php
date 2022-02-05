<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Source\CreateRequest;
use App\Http\Requests\Source\UpdateRequest;
use App\Models\Source;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sources = Source::paginate(10);
        return view('admin.sources.index', ['sources' => $sources]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        $created = Source::create($data);
        if($created) {

            return redirect()->route('admin.sources.index')
                ->with('success', __('messages.admin.sources.created.success'));
        }
        return back()
            ->with('error', __('messages.admin.sources.created.eror'))
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        return view('admin.sources.edit', ['source' => $source]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Source $source
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Source $source)
    {
        $data = $request->validated();
        $updated = $source->fill($data)->save();
        if($updated){

            return redirect()->route('admin.sources.index')
                ->with('success', __('messages.admin.sources.updated.success'));
        }
        return back()
            ->with('error', __('messages.admin.sources.updated.error'))
            ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Source $source
     * @return \Illuminate\Http\Response
     */
    public function destroy(Source $source)
    {
        try{
            $source->delete();
            return response()->json('ok');
        }catch (Exception $e) {
            Log::error('Source error destroy', [$e]);
            return response()->json('error', 400);
        }
    }
}
