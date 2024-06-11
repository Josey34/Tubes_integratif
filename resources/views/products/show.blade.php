@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h1>Order Details</h1>
                        <img src="{{ url('storage', $product->image) }}" alt="" width="200px">
                        <p>Name: {{ $product->product_name }}</p>
                        <p>Description: {{ $product->description }}</p>
                        <p>Price: {{ $product->price }}</p>
                        <p>Weight: {{ $product->weight }}</p>
                        <p>Address from: {{ $product->address_from }}</p> <!-- This will display the city name -->
                        <p>Stock: {{ $product->stock }}</p>
                        <form action="{{ route('orders.checkout', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Order</button>
                        </form>
                    </div>
                </div>
                <a href="/product" class="btn btn-secondary">Back to Product</a>
            </div>
        </div>
    </div>
@endsection
