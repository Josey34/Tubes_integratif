@extends('layouts.main')

@section('container')
    <main class="px-28 mt-8 grid grid-cols-3 gap-4">
        <div class="bg-slate-600 w-full h-[409px] object-cover rounded-xl">
            <img src="{{ url('storage', $product->image) }}" alt="" class="w-full h-[409px] rounded-xl object-cover">
        </div>
        <div>
            <h3 class="mt-2 px-4 text-4xl text-gray-800 font-semibold">
                {{ $product['product_name'] }}
            </h3>
            <p class="mt-2 px-4 text-lg text-gray-800">
                {{ Str::limit($product['description'], 100) }}
            </p>
        </div>
        <div class="bg-white rounded-xl p-5 h-fit">
            <h3 class="mt-2 text-2xl text-gray-800 font-semibold">
                Estimasi Harga
            </h3>
            <p class="mt-6 text-4xl text-green-600 font-bold">
                Rp{{ $product['price'] }}
            </p>
            <form action="{{ route('orders.checkout', $product->id) }}" method="GET" style="display:inline;">
                @csrf
                <button type="submit"
                    class="px-6 py-3 w-full bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold mt-6">Pesan
                    Produk</button>
            </form>
        </div>
    </main>

    {{-- <div class="container">
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
                        <form action="{{ route('orders.checkout', $product->id) }}" method="GET" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Order</button>
                        </form>
                    </div>
                </div>
                <a href="/product" class="btn btn-secondary">Back to Product</a>
            </div>
        </div>
    </div> --}}
@endsection
