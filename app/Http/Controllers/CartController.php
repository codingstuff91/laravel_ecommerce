<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->title, $request->id, $request->price);
        Cart::add($request->id,$request->title,1,$request->price)->associate('App\Product');
        return redirect()->route('products.index')->with('success','Le produit a bien été ajouté');
    }
}
