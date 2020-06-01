@extends('layouts.master')

@section('content')

<h1 class="text-center">Votre panier</h1>

@if (Cart::count()>0)   
<div class="px-4 px-lg-0">
    <div class="pb-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
  
            <!-- Shopping cart table -->
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="border-0 bg-light">
                      <div class="p-2 px-3 text-uppercase">Produit</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Prix</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Quantité</div>
                    </th>
                    <th scope="col" class="border-0 bg-light">
                      <div class="py-2 text-uppercase">Supprimer</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  {{-- Display the cart elements --}}
                  @foreach (Cart::content() as $product)
                    <tr>
                      <th scope="row">
                        <div class="p-2">
                          <img src="{{ $product->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                          <div class="ml-3 d-inline-block align-middle">
                              <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">{{ $product->model->title }}</a></h5><span class="text-muted font-weight-normal font-italic">Category:</span>
                          </div>
                        </div>
                      </th>
                        <td class="align-middle"><strong>{{ $product->model->getPrice() }}</strong></td>
                        <td class="align-middle"><strong>1</strong></td>
                        <td class="align-middle">
                            <form action="{{ route('cart.destroy',$product->rowId) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>                   
                  @endforeach
  
                </tbody>
              </table>
            </div>
            <!-- End -->
          </div>
        </div>
  
        <div class="row py-5 p-4 bg-white rounded shadow-sm">
          <div class="col-lg-12">
            <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
            <div class="p-4">
              <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
              <ul class="list-unstyled mb-4">
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Sous total </strong><strong>{{ getPrice(Cart::subtotal()) }}</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Frais de port</strong><strong>0</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">TVA</strong><strong>{{ getPrice(Cart::tax()) }}</strong></li>
                <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                  <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
                </li>
              </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Procéder au paiement</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@else
    <div class="col-xs-12 alert alert-warning">
        <p class="text-center">Votre panier est vide</p>
    </div>
@endif


    
@endsection