@extends('layouts.main')

@section('container')
    <div class="container">
        <h1 class="my-4">Orders</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
            @forelse ($orders as $order)
                <div class="col mb-4">
                    <div class="card h-100">
                        @if ($order->product)
                            <img src="{{ url('/storage/' . $order->product->image) }}" class="card-img-top" alt="Product Image">
                        @else
                            <div class="card-img-top text-center py-5">
                                <p class="h5">Product Image Not Available</p>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->product ? $order->product->product_name : 'Product not found' }}</h5>
                            <p class="card-text">Quantity: {{ $order->quantity }}</p>
                            <p class="card-text">Total: Rp. {{ $order->total }}</p>
                        </div>
                        <form action="{{ route('checkout', $order->product->id) }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                        </form>
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
