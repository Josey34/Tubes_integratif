<!-- index.blade.php -->

@extends('layouts.main')

@section('container')
    <h1 class="mb-3 mt-5 text-center">Products</h1>

    <form action="{{ route('product.index') }}" method="GET" class="d-flex mb-5">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
            value="{{ $search }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ url('storage', $product->image) }}" alt="" width="200px">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Price: {{ $product->price }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $products->links() }}
    </div>
@endsection
