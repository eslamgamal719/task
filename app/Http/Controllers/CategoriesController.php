<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return response()->json(CategoryResource::collection($categories), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriesRequest $request)
    {
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            Category::create($data);

            return response()->json('Created successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }

    public function show(Category $category)
    {
        return response()->json(new CategoryResource($category), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriesRequest $request, Category $category)
    {
        try {
            $data = [];
            $data['name'] = $request->name;
            $data['description'] = $request->description;

            $category->update($data);

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
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return response()->json('Deleted successfully', 200);

        } catch (\Exception $e) {

            return response()->json($e->getMessage());

        }
    }
}
