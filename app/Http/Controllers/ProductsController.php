<?php

namespace App\Http\Controllers;
use App\Models\Products;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('category')->orderBy('created_at', 'DESC')->get();

        $products->transform(function($product) {
            $product->category_name = $product->category->category_name;
            unset($product->category); // Gerekli değilse, bu satırı ekleyebilirsiniz.
            return $product;
        });
    
        return response()->json($products);       
    }
    public function show($id){
        $product = Products::with('category')->find($id);
        if($product){
            $product->category_name = $product->category->category_name;
            unset($product->category);
            return response()->json($product);
        }else{
            return response()->json(['message' => 'Product not found'], 404);
        };
     
    }
    public function update($id,Request $request){
        $product = Products::find($id);
        $isFavorite = $request->has('isFavorite') ? $request->input('isFavorite') : $product->isFavorite ;
        $isCart = $request->has('isCart') ? $request->input('isCart') : $product->isCart ;
        $product->isFavorite = $isFavorite;
        $product->isCart = $isCart;
        if ($isCart) {
            // If isCart is true, increase quantity by 1
            $product->qty += 1;
        }else{
            $product->qty=0;
        };
        $product->save();
        return response()->json(['message' => 'Product updated successfully'], 200);
    }
    public function search(Request $request)
    {
        $product_name = $request->input('product_name');
    
        if($product_name) {
            $results = Products::where('product_name', 'LIKE', '%' . $product_name . '%')->orderBy('created_at','DESC')->get();
            return $results;
        }
    
        return [];
    }
}