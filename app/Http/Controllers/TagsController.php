<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagsRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::get();
        return response()->json(TagResource::collection($tags), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagsRequest $request)
    {
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            Tag::create($data);

            return response()->json('Created successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }

    public function show(Tag $tag)
    {
        return response()->json(new TagResource($tag), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagsRequest $request, Tag $tag)
    {
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            $tag->update($data);

            return response()->json('Updated successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        try {
            $tag->delete();

            return response()->json('Deleted successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }
}
