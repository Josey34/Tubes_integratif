@extends('dashboard.layouts.main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
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
                        <a href="{{ route('dashboard.edit', $product->id) }}" class="btn btn-warning">Edit Product</a>
                        <form action="{{ route('dashboard.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete
                                Product</button>
                        </form>
                        {{-- <form action="{{ route('orders.checkout', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Order</button>
                        </form> --}}
                    </div>
                </div>
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Back to Product</a>
            </div>
        </div>
    </div>
</main>
@endsection
