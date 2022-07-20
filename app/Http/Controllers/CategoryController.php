<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        return response()->view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return response()->view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        
        $category = new Category();
        $category->name = $request->input('name');
        $category->is_active = $request->input('active');
        $isSaved = $category->save();

        return response()->json([
            'message' => $isSaved ? 'Category Created Successfully!' : 'Failed to create a category, Please try again.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
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
    public function edit(Category $category)
    {
        return response()->view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request,Category $category)
    {
        $category->name = $request->input('name');
        $category->is_active = $request->input('active');
        $isSaved = $category->save();

        return response()->json([
            'message' => $isSaved ? 'Category Created Successfully!' : 'Failed to create a category, Please try again.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $isDeleted = $category->delete();
        return response()->json([
            'title' => $isDeleted ? 'Deleted!' : 'Failed',
            'message' => $isDeleted ? 'Category Deleted Successfully!' : 'Failed to delete category, Please try again.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


        //Function to toggle in the active Button
        public function toggleActivation(Category $category) {

            $status = -1;
            if($category->is_active) {
                $category->is_active = false;
                $message = 'Coin Deactivated Successfully';
                $status = 2;
            } else {
                $category->is_active = true;
                $message = 'Coin Activated Successfully';
                $status = 1;
            }
            $isSaved = $category->save();
            return response()->json([
                'message' => $isSaved ? $message : 'Failed to toggle the category, Please try again',
                'status' => $status,
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
