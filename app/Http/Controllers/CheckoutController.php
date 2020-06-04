<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Cart::count() == 0)
        {
            return redirect()->route('products.index');
        }

        Stripe::setApiKey('sk_test_51GqI2FFgsOsmNHZpsbwjWylfkDsXs6VgSkxPZnylVhjsGP09FyoouGa9SjDndSnRPxau1aWcqSxNIiia0TLSmfRQ00pmNniih9');

        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'eur',
          ]);

        $client_secret = Arr::get($intent,'client_secret');

        return view('checkout.index', [
            "client_secret" => $client_secret
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Cart::destroy();
        $data = $request->json()->all();
        return $data["paymentIntent"];
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
