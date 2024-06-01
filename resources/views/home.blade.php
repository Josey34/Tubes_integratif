@extends('layouts.main')

@section('container')
    <div class="container">
        <h1>Halaman Home</h1>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="{{ url('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->product_name }}" height="100px">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View Product</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-2">Delete Product</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
