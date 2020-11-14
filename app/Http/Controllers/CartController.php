<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

    public function store(Request $request)
    {
        //Search for duplicates references
        $duplicata = Cart::search(function($cartItem,$rowId) use ($request){
            return $cartItem->id === $request->product_id;
        });
                
        if ($duplicata->isNotEmpty()) {
            return redirect()->route('products.index')->with('duplicate', 'Le produit existe deja dans le panier');
        }
        
        $product = Product::find($request->product_id);
        Cart::add($request->product_id,$product->title,1,$product->price)->associate('App\Product');

        return redirect()->route('products.index')->with('success','Le produit a bien été ajouté');
    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return back()->with('success','Le produit a bien été supprimé');
    }

    public function update(Request $request)
    {
        Cart::update($request['rowId'], $request->new_qty);

        Session::flash('success','La quantité à été mise à jour');

        return response()->json(["success", "Quantité mise à jour"]);
    }


}
