<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-white">
        <div class="grid grid-cols-2 gap-0">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            <div class="p-52">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/RooftopMart..png') }}" alt="">
                </a>
                <h2 class="mt-20 text-4xl text-gray-800 font-bold capitalize">
                    Masuk ke akunmu.
                </h2>
                <p class="mt-2 text-lg text-gray-400">
                    Silakan isi detail berikut untuk melanjutkan.
                </p>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-semibold text-gray-800">Email</label>
                        <input type="email" name="email"
                            class="w-full p-2 border border-gray-300 rounded-lg mt-1 @error('email') is-invalid @enderror"
                            id="email" value="{{ old('email') }}" placeholder="Masukkan Email">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-lg font-semibold text-gray-800">Password</label>
                        <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded-lg mt-1"
                            id="password" placeholder="Masukkan Password">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white rounded-lg w-full hover:bg-green-800 text-xl font-semibold">Masuk</button>
                </form>
                <p class="mt-4 text-center text-gray-400">
                    Belum punya akun? <a href="{{ route('register') }}"
                        class="text-green-600 font-semibold underline hover:text-green-800">Daftar
                        Sekarang</a>
                </p>
            </div>

            <div class="flex object-fill">
                <img src="{{ asset('assets/images/login.png') }}" alt="" class="w-full">
            </div>
        </div>
    </div>
</body>

</html>
