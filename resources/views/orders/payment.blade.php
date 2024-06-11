@extends('layouts.main')

@section('container')
    <div class="container">
        <h1>Payment</h1>

        <div class="card m-3" style="width: 18rem;">
            <img src="{{ url('/storage/' . $product->image) }}" alt="Product Image" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Weight: {{ $product->weight }}</p>
                <p>Address From: {{ $product->address_from }}</p>
                <p>Stock: {{ $product->stock }}</p>
            </div>
        </div>

        <h2>Shipping Services</h2>
        @if ($services)
            <ul>
                <!-- Showing only the first item in the services array -->
                <li>{{ $services[0]['service'] }} - {{ $services[0]['description'] }}: {{ $services[0]['cost'] }} (est: {{ $services[0]['etd'] }} days)</li>
            </ul>
            <p>Total product = {{ $total }}</p>
        @else
            <p>No shipping services found.</p>
        @endif
        <form action="{{ route('order.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="address_from" value="{{ $product->address_from }}">
            <input type="hidden" name="address_to" value="{{ request('destination') }}">
            <input type="hidden" name="courier" value="{{ $courier }}">
            <input type="hidden" name="quantity" value="{{ request('quantity') }}">
            <input type="hidden" name="total" value="{{ $total }}">
            <input type="hidden" name="payment" value="0"> <!-- Example payment method -->
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>
@endsection
