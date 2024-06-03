@extends('layouts.main')

@section('container')
    <div class="container">
        <h1>Checkout</h1>
        <div class="card m-3" style="width: 18rem;">
            <img src="{{ url('/storage/' . $product->image) }}" alt="Card image cap" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{$product->product_name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Weight: {{ $product->weight }}</p>
                <p>Address From: {{ $product->address_from }}</p>
                <p>Stock: {{ $product->stock }}</p>
            </div>
        </div>

        <!-- Checkout form -->
        <form action="" method="">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="form-group">
                <label for="address_to">Address To:</label>
                <input type="text" class="form-control" id="address_to" name="address_to">
            </div>

            <div class="form-group">
                <label for="courier">Courier:</label>
                <input type="text" class="form-control" id="courier" name="courier">
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $order->quantity }}">
            </div>

            <!-- Total will be calculated based on product price and quantity -->
            <input type="hidden" name="total" value="{{ $product->price * ($order->quantity ?? 1) }}">

            <div class="form-group">
                <label for="payment">Payment:</label>
                <input type="text" class="form-control" id="payment" name="payment" value="pending" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Checkout</button>
        </form>

    </div>
@endsection
