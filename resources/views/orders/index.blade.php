@extends('layouts.main')

@section('container')
    <div class="container">
        <h1 class="my-4">Orders</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @forelse ($orders as $order)
                <div class="col mb-4">
                    <div class="card h-100">
                        @if ($order->product && $order->product->image)
                            <img src="{{ url('/storage/' . $order->product->image) }}" alt="Product Image"
                                class="card-img-top">
                        @else
                            <p>No product image available</p>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->product ? $order->product->product_name : 'Product not found' }}</h5>
                            <p class="card-text">Quantity: {{ $order->quantity }}</p>
                            <p class="card-text">Total: Rp. {{ $order->total }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <div class="alert alert-info" role="alert">
                        No orders available.
                    </div>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-4">

        </div>
    </div>
@endsection
