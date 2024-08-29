<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Validator;

class NewsController extends Controller
{

    public function index()
    {
        return News::all();
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'subtitle'=>'required',
            'content'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' =>'error'], 422);
        }

        News::create($request->all());
        return $request;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return News::find($id);
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title'=>'required',
            'subtitle'=>'required',
            'content'=>'required'
        ]);

        if($validator->fails()){
            return response()->json(['message' =>'error'], 422);
        }

        $validated = $validator->validated();
        $news = News::find($id);
        $news->update($validated);

        return $validated;

    }

    public function destroy(string $id)
    {
        $news = News::find($id);
        $news->delete();
    }
}
