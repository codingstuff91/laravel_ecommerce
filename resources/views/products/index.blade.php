@extends('layouts.master')

@section('content')

<div class="row mb-2">
    @foreach ($products as $product)
        <div class="col-md-6">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 d-flex flex-column position-static">

                    <small class="d-inline-block mb-4">
                        @foreach ($product->categories as $category)
                        <span class="p-2 product-category mb-4">{{ $category->name }}</span>
                        @endforeach
                    </small>

                    <h3 class="mb-2">{{ $product->title }}</h3>
                    <p>{{ $product->created_at->format('d/m/Y') }}</p>
                    <strong class="product_price mb-2">{{ $product->getPrice() }}</strong>
                    <a href="{{ route('products.show',$product->id) }}" class="btn btn-info">Consulter le produit</a>
                </div>

                <div class="col-auto d-none d-lg-block">
                    <img src="{{ asset('storage/'.$product->image) }}" alt="product_image" class="product_image">
                </div>
            </div>
        </div>        
    @endforeach
    {{ $products->appends(request()->input())->links() }}
</div>

    
@endsection