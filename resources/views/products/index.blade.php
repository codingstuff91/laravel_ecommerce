@extends('layouts.master')

@section('content')

<div class="row mb-2">
    @foreach ($products as $product)
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <small class="d-inline-block mb-2">
                    @foreach ($product->categories as $category)
                       <span class="badge badge-danger py-2">{{ $category->name }}</span>
                    @endforeach
                </small>
                <h3 class="mb-0">{{ $product->title }}</h3>
                <p>{{ $product->created_at->format('d/m/Y') }}</p>
                <strong>{{ $product->getPrice() }}</strong>
                <a href="{{ route('products.show',$product->id) }}" class="btn btn-success btn-block">Voir la fiche du produit</a>
            </div>    
            <div class="col-auto d-none d-lg-block">
                <img src="{{ $product->image }}" alt="">
            </div>
            </div>
        </div>        
    @endforeach
</div>

    
@endsection