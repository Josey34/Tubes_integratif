@extends('layouts.main')

@section('container')
    <main class="mt-16">
        <h2 class="text-3xl text-gray-800 font-bold capitalize text-center">
            Blog dan Artikel Terkini.
        </h2>
        <p class="mt-2 text-lg text-gray-400 text-center">
            Tersedia berbagai macam informasi berupa blog dan artikel seputar dunia perkebunan <br> dan manfaatnya.
            Lengkap dan ter-update.
        </p>
        <section class="px-28 mt-40 mb-40">
            <div class="mt-8 grid grid-cols-4 gap-5">
                {{-- looping berita di sini --}}
                @foreach ($newsdata as $news)
                    <a href="{{ $news['link'] }}">
                        <div class="bg-white rounded-xl">
                            <div class="w-full h-56 bg-gray-400 rounded-t-xl">
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
    </main>
@endsection
