@extends('layouts.main')

@section('container')
    <main class="px-28 mt-8 grid grid-cols-2 gap-12">
        <div>
            <div class="bg-slate-600 h-full w-full object-cover rounded-xl">
                <img src="{{ url('/storage/' . $product->image) }}" alt="Product Image"
                    class="w-full h-full rounded-xl object-cover">
            </div>
            {{-- <div class="hidden">
                <h5 class="card-title">{{ $product->product_name }}</h5>
                <p class="card-text">{{ $product->description }}</p>
                <p>Price: {{ $product->price }}</p>
                <p>Weight: {{ $product->weight }}</p>
                <p>Address From: {{ $product->address_from }}</p>
                <p>Stock: {{ $product->stock }}</p>
            </div> --}}
        </div>

        <div class="p-9 bg-white rounded-xl h-fit">
            <h2 class="text-3xl text-gray-800 font-bold capitalize mb-6">Ringkasan Pesanan</h2>
            @if ($services)
                <div>
                    <p class="text-xl text-gray-800 font-semibold capitalize mb-3">
                        {{ $product['product_name'] }}
                    </p>
                </div>
                <div class="mb-3">
                    <h5 class="text-xl text-gray-800 font-semibold capitalize">
                        Ringkasan Pengiriman
                    </h5>
                    <p class="text-lg text-gray-800 capitalize">
                        {{ $services[0]['service'] }} - {{ $services[0]['description'] }}: {{ $services[0]['cost'] }} (est:
                        {{ $services[0]['etd'] }} days)
                    </p>
                </div>
                <div>
                    <h5 class="text-xl text-gray-800 font-semibold capitalize">
                        Total yang Harus Dibayar (+Ongkir)
                    </h5>
                    <p class="text-2xl text-green-600 font-bold">Rp{{ $total }}</p>
                </div>
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
                <button type="submit"
                    class="px-6 py-3 w-full bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold mt-10">Pembayaran</button>
            </form>
            @if ($product->stock == 0)
                <p>Stock Habis</p>
            @endif
        </div>

    </main>
@endsection
