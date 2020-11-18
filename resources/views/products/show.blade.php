@extends('layouts.master')

@section('content')

<div class="row mb-2">
    <h1 class="mt-2">{{ $product->title }}</h1>
</div>
<div class="row mb-2">
    <div class="col-8">
        <h2 class="mt-2">{{ $product->description }}</h2>
    </div>
    <div class="col-4">
        <img src="{{ asset('storage/'. $product->image) }}" alt="">
    </div>
    <p>{{ $product->getPrice() }}</p>
</div>
<div class="row mb-2">
    <form action="{{ route('cart.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="submit" class="btn btn-success" value="Ajouter au panier">
    </form>
</div>

    
@endsection