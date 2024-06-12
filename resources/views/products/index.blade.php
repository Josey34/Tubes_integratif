<!-- index.blade.php -->

@extends('layouts.main')

@section('container')
    <main class="mt-16">
        <h2 class="text-3xl text-gray-800 font-bold capitalize text-center">
            Telusuri Produk-produk Kami.
        </h2>
        <p class="mt-2 text-lg text-gray-400 text-center">
            Aneka macam produk segar dan olahan rooftop ada di sini!.
        </p>
        <form action="{{ route('product.index') }}" method="GET" class="flex justify-center">
            <div class="flex items-center justify-between mt-16">
                <input type="search" name="search" placeholder="Cari Produk..."
                    class="w-96 p-2 border border-gray-300 rounded-lg mt-1" value="{{ $search }}">
                {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search"
                value="{{ $search }}"> --}}
                <button class="ml-3 px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-800 text-base font-semibold"
                    type="submit">Search</button>
            </div>
        </form>
        <section class="px-28 mt-40 mb-40">
            <div class="mt-8 grid grid-cols-4 gap-4">
                {{-- looping product di sini --}}
                @foreach ($products as $product)
                    <a href="{{ route('products.show', $product['id']) }}">
                        <div class="bg-white rounded-xl">
                            <div class="w-full h-56 bg-red-400 rounded-t-xl">
                                <img class="w-full h-full object-cover rounded-t-xl"
                                    src="{{ url('storage', $product['image']) }}" alt="{{ $product['product_name'] }}" />
                            </div>
                            <h3 class="mt-2 px-4 text-xl text-gray-800 font-semibold">
                                {{ $product['product_name'] }}
                            </h3>
                            <p class="mt-2 px-4 text-sm text-gray-800">
                                {{ Str::limit($product['description'], 100) }}
                            </p>
                            <p class="px-4 py-8 text-2xl text-green-600 font-bold">
                                Rp{{ $product['price'] }}
                            </p>
                        </div>
                    </a>
                @endforeach

            </div>

            <div class="justify-center mt-3 block">
                {{ $products->links() }}
            </div>

        </section>
    </main>
@endsection
