<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdsRequest;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ads = Ad::with('category', 'tags');

        if(isset($request->category)) {
            $ads->whereCategoryId($request->category);
        }

        if(isset($request->tag)) {
            $ads->whereHas('tags', function($q) use($request) {
                $q->where('tags.id', $request->tag);
            });
        }

        $ads = $ads->paginate();

        return response()->json(AdResource::collection($ads), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdsRequest $request)
    {
        try {
            $data = [];
            $data['title']          = $request->title;
            $data['description']    = $request->description;
            $data['start_date']     = $request->start_date;
            $data['type']           = $request->type;
            $data['category_id']    = $request->category_id;
            $data['user_id']        = $request->user_id; // it should be the auth user

            $ad = Ad::create($data);

            if($request->tags) {
                $tags = json_decode($request->tags, true);
                $ad->tags()->attach($tags);
            }

            return response()->json('Created successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }

    public function show(Ad $ad)
    {
        return response()->json(new AdResource($ad), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdsRequest $request, Ad $ad)
    {
        try {
            $data = [];
            $data['title']          = $request->title;
            $data['description']    = $request->description;
            $data['start_date']     = $request->start_date;
            $data['type']           = $request->type;
            $data['category_id']    = $request->category_id;
            $data['user_id']        = $request->user_id; // it should be the auth user

            $ad->update($data);

            if($request->tags) {
                $tags = json_decode($request->tags, true);
                $ad->tags()->attach($tags);
            }

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
    public function destroy(Ad $ad)
    {
        try {
            $ad->delete();

            return response()->json('Deleted successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }
}
