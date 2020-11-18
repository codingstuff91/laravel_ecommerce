<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if($request->category)
        {
            $products = Product::with('categories')->whereHas('categories', function($query) use ($request) {
                $query->where('slug', $request->category);
            })->paginate(6);
        }else{
            
            $products = Product::with('categories')->paginate(6);
        }
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $products = Product::where('title','like',"%" . $request['query'] . "%")
                            ->orWhere('description', "%" . $request['query'] . "%")
                            ->get();

        return view('products.search')->with('products',$products);
    }
}
