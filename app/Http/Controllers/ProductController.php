<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequset;
use App\Http\Requests\UpdateProductRequset;

use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::all();
        return response()->view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categoris = Category::get();
        return response()->view('products.create',compact('categoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequset $request)
    {
        //


        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_name');
        $product->description = $request->input('description');
        $product->keywords = $request->input('keywords');
        $product->is_active = $request->input('active');

        if($request->hasFile('image'))
        {
            $file=$request->file('image');
            $image_path=$file->store('uploads','public');
            $product->image=$image_path;
        }

        if($request->hasFile('barcode'))
        {
            $file=$request->file('barcode');
            $image_path=$file->store('uploads','public');
            $product->barcode=$image_path;
        }
        $isSaved = $product->save();
        return response()->json([
            'message' => $isSaved ? 'product Created Successfully!' : 'Failed to create a product, Please try again.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        return response()->view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequset $request, Product $product)
    {
        //
        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode');
        $product->category_id = $request->input('category_name');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        $product->keywords = $request->input('keywords');
        $product->is_active = $request->input('active');
        $isSaved = $product->save();
        return response()->json([
            'message' => $isSaved ? 'product Created Successfully!' : 'Failed to create a product, Please try again.',
        ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $isDeleted = $product->delete();
        return response()->json([
            'title' => $isDeleted ? 'Deleted!' : 'Failed',
            'message' => $isDeleted ? 'product Deleted Successfully!' : 'Failed to delete product, Please try again.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }


   //Function to toggle in the active Button
    public function toggleActivation(Product $coin) {

        $status = -1;
        if($coin->is_active) {
            $coin->is_active = false;
            $message = 'Coin Deactivated Successfully';
            $status = 2;
        } else {
            $coin->is_active = true;
            $message = 'Coin Activated Successfully';
            $status = 1;
        }
        $isSaved = $coin->save();
        return response()->json([
            'message' => $isSaved ? $message : 'Failed to toggle the coin, Please try again',
            'status' => $status,
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
