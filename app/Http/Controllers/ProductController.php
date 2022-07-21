<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Http\Requests\StoreProductRequset;
use App\Http\Requests\UpdateProductRequset;
use App\Models\Coin;
use Illuminate\Support\Facades\Storage;
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
        $products = Product::with('category')->get();
        return response()->view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        $coins = Coin::where('is_active', true)->get();
        return response()->view('products.create', compact('categories', 'coins'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequset $request)
    {
        $price_arr = explode('.', $request->input('price'));
        if(count($price_arr) > 1) {
            $coin = Coin::findOrFail($request->input('coin'));
            if(strlen($price_arr[1]) > $coin->max_decimal_numbers) {
                return response()->json([
                    'message' => 'Maximum dicimal number of coin ' . $coin->name . ' is ' . $coin->max_decimal_numbers,
                ], Response::HTTP_BAD_REQUEST); 
            }
        }
        $product = new Product();
        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode');
        $product->category_id = $request->input('category');
        $product->description = $request->input('description');
        $product->keywords = explode(',', $request->input('keywords'));
        $product->is_active = $request->input('active') == '1';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image_path = $file->store('uploads', 'public');
            $product->image = $image_path;
        }
        $product->price = $request->input('price');
        $product->coin_id = $request->input('coin');

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
        $categories = Category::where('is_active', true)->get();
        $coins = Coin::where('is_active', true)->get();
        return response()->view('products.edit', compact('product', 'categories', 'coins'));
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
        $product->name = $request->input('name');
        $product->barcode = $request->input('barcode');
        $product->category_id = $request->input('category');
        $product->description = $request->input('description');
        $product->keywords = explode(',', $request->input('keywords'));
        $product->is_active = $request->input('active') == '1';

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('' . $product->image);
            $file = $request->file('image');
            $image_path = $file->store('uploads', 'public');
            $product->image = $image_path;
        }
        $product->price = $request->input('price');
        $product->coin_id = $request->input('coin');

        $isSaved = $product->save();
        return response()->json([
            'message' => $isSaved ? 'product Updated Successfully!' : 'Failed to update a product, Please try again.',
        ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $imagePath = $product->image;
        $isDeleted = $product->delete();
        if ($isDeleted) {
            Storage::disk('public')->delete('' . $imagePath);
        }
        return response()->json([
            'title' => $isDeleted ? 'Deleted!' : 'Failed',
            'message' => $isDeleted ? 'product Deleted Successfully!' : 'Failed to delete product, Please try again.',
            'icon' => $isDeleted ? 'success' : 'error'
        ], $isDeleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

}