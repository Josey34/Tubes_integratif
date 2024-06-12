@extends('layouts.main')

@section('container')
    <main class="mt-16">
        <h1 class="text-5xl text-gray-800 font-bold capitalize text-center">
            Nikmati produk buah dan <br> sayuran yang segar langsung <br> dari kebunnya.
        </h1>
        <p class="mt-6 text-lg text-gray-400 text-center">
            Kami menyediakan berbagai macam jenis produk hasil panen kebun yang berkualitas. <br> Setiap proses
            penanaman dilakukan seperti membesarkan anak sendiri.
        </p>
        <div class="mt-10 flex justify-center">
            <a href="#product-start"
                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold">Mulai
                Belanja Sekarang</a>
        </div>
        {{-- section produk buah/sayuran rooftop --}}
        <section class="px-28 mt-40" id="product-start">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl text-gray-800 font-bold capitalize">
                    Produk Hasil Perkebunan Rooftop.
                </h2>
                <a href="{{ route('product.index') }}" class="text-gray-400 text-xl underline">
                    Lihat Semua
                </a>
            </div>
            <p class="mt-2 text-lg text-gray-400">
                Berikut adalah beragam hasil produk dari perkebunan Rooftop. Kualitasnya sangat <br> terjamin, dengan
                hasil produk yang bervariasi.
            </p>
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
        </section>

        {{-- section API berita --}}
        <section class="px-28 mt-40">
            <div class="flex items-center justify-between">
                <h2 class="text-3xl text-gray-800 font-bold capitalize">
                    Blog dan Artikel
                </h2>
                <a href="{{ route('news.index') }}" class="text-gray-400 text-xl underline">
                    Lihat Semua
                </a>
            </div>
            <p class="mt-2 text-lg text-gray-400">
                Tersedia berbagai macam informasi berupa blog dan artikel seputar dunia perkebunan <br> dan manfaatnya.
                Lengkap dan ter-update.
            </p>
            <div class="mt-8 grid grid-cols-4 gap-4">
                {{-- looping product di sini --}}
                @foreach ($newsdata as $news)
                    <a href="{{ $news['link'] }}">
                        <div class="bg-white rounded-xl">
                            <div class="w-full h-56 bg-red-400 rounded-t-xl">
                                <img class="w-full h-full object-cover rounded-t-xl" src="{{ $news['image_url'] }}"
                                    alt="{{ $news['title'] }}" />
                            </div>
                            <h3 class="mt-2 px-4 text-xl text-gray-800 font-semibold">
                                {{ Str::limit($news['title'], 60) }}
                            </h3>
                            <p class="mt-2 px-4 text-sm text-gray-800">
                                {{ Str::limit($news['description'], 100) }}
                            </p>
                            <p class="mt-2 px-4 text-sm text-gray-400">
                                Dibuat pada: {{ date('d-m-Y', strtotime($news['pubDate'])) }}
                            </p>
                            <p class="mt-6 pb-12 px-4 text-sm text-gray-800">
                                Sumber: {{ $news['source_id'] }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="px-28 py-28 mt-40">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl text-gray-800 font-bold capitalize">
                        Mitra Kerjasama RooftopMart.
                    </h2>
                    <p class="mt-2 text-lg text-gray-400">
                        Telah dipercaya oleh mitra kerjasama Rooftop dalam <br> pemenuhan kebutuhan pangan nasional.
                    </p>
                </div>
                <img src="{{ asset('assets/images/Frame 12.png') }}" alt="">
            </div>
        </section>

    </main>
@endsection
