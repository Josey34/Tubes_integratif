<!-- resources/views/orders/checkout.blade.php -->

@extends('layouts.main')

@section('container')
    <div class="container">
        <h1>Checkout</h1>

        <!-- Display error messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card m-3" style="width: 18rem;">
            <img src="{{ url('/storage/' . $product->image) }}" alt="Card image cap" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Weight: {{ $product->weight }}</p>
                <p>Address From: {{ $product->address_from }}</p>
                <p>Stock: {{ $product->stock }}</p>
            </div>
        </div>

        <!-- Checkout form -->
        <form method="POST" action="/orders/payment">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="address_from" value="{{ $product->address_from }}">
            <input type="hidden" name="weight" value="{{ $product->weight }}">

            <div class="form-group">
                <label for="destination">Destination City:</label>
                <select class="form-control" id="destination" name="destination">
                    @foreach ($cities as $city)
                        <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="courier">Courier</label>
                <select name="courier" id="courier" class="form-control" required>
                    <option value="">Select Courier</option>
                    <option value="jne">JNE</option>
                    <option value="pos">POS</option>
                    <option value="tiki">TIKI</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1">
            </div>

            <button type="submit" class="btn btn-primary">Order</button>
        </form>
    </div>
@endsection
