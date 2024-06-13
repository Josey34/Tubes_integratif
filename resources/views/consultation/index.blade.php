@extends('layouts.main')

@section('container')
    <main class="px-28 mt-16 mb-16">
        <div class="p-12 bg-white rounded-xl w-full">
            <img src="{{ asset('assets/images/ilus1.png') }}" alt="" class="m-auto">
            <h2 class="text-3xl text-gray-800 font-bold capitalize text-center">
                Punya Kendala Terkait RooftopMart.? <br> Yuk Konsultasikan Bersama Kami
            </h2>
            <p class="mt-6 text-lg text-gray-400 text-center">
                Kami siap membantu Anda dalam menyelesaikan masalah yang Anda hadapi. <br> Silahkan hubungi kami melalui
                kontak yang tersedia.
            </p>
            <div class="mt-10 flex justify-center">
                <a href="{{ route('customer.service.whatsapp') }}"
                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold"
                    target="_blank">Mulai
                    Konsultasi</a>
            </div>
        </div>
    </main>
@endsection
