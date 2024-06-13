<!-- resources/views/orders/checkout.blade.php -->

@extends('layouts.main')

@section('container')
    <main class="px-28 mt-8 grid grid-cols-2 gap-12">
        <div class="">
            <div class="bg-slate-600 h-full w-full object-cover rounded-xl">
                <img src="{{ url('/storage/' . $product->image) }}" alt="Card image cap"
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
            <!-- Checkout form -->
            <h2 class="text-3xl text-gray-800 font-bold capitalize">
                Informasi Lainnya
            </h2>
            <p class="mt-2 text-lg text-gray-400">
                Lengkapi Pengiriman Produk Pesanan Anda.
            </p>
            <form method="POST" action="/orders/payment">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="address_from" value="{{ $product->address_from }}">
                <input type="hidden" name="weight" value="{{ $product->weight }}">

                <div class="mt-4">
                    <label for="destination" class="text-xl text-gray-800 font-semibold capitalize mb-1">Pilih
                        Destinasi</label><br>
                    <select
                        class="w-full px-6 py-3 bg-white border-2 border-gray-500 focus:border-green-600 text-gray-700 rounded-lg"
                        id="destination" name="destination">
                        @foreach ($cities as $city)
                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-2">
                    <label for="courier" class="text-xl text-gray-800 font-semibold capitalize mb-1">Pilih
                        Kurir</label><br>
                    <select name="courier" id="courier"
                        class="w-full px-6 py-3 bg-white border-2 border-gray-500 focus:border-green-600 text-gray-700 rounded-lg"
                        required>
                        <option value="">Pilih Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="pos">POS</option>
                        <option value="tiki">TIKI</option>
                    </select>
                </div>

                <div class="mt-2">
                    <label for="quantity" class="text-xl text-gray-800 font-semibold capitalize mb-1">Masukkan Kuantitas
                        Pembelian</label><br>
                    <input type="number"
                        class="w-full px-6 py-3 bg-white border-2 border-gray-500 focus:border-green-600 text-gray-700 rounded-lg"
                        id="quantity" name="quantity" value="{{ $order->quantity ?? 1 }}">
                </div>

                <button type="submit"
                    class="px-6 py-3 w-full bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold mt-10">Selanjutnya</button>
            </form>
        </div>

    </main>
@endsection
