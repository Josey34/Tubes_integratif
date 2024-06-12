<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div>

        <div class="grid grid-cols-2 gap-0">
            <div class="p-52">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/images/RooftopMart..png') }}" alt="">
                </a>
                <h2 class="mt-20 text-4xl text-gray-800 font-bold capitalize">
                    Buat Akunmu.
                </h2>
                <p class="mt-2 text-lg text-gray-400">
                    Silakan isi detail berikut untuk melanjutkan
                </p>
                <form method="POST" action="{{ route('store_register') }}" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-semibold text-gray-800">Nama</label>
                        <input type="text" id="name" name="name" placeholder="Masukkan Nama"
                            class="w-full p-2 border border-gray-300 rounded-lg mt-1" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-semibold text-gray-800">Email</label>
                        <input type="email" id="email" name="email" placeholder="Masukkan Email"
                            class="w-full p-2 border border-gray-300 rounded-lg mt-1" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-lg font-semibold text-gray-800">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password"
                            class="w-full p-2 border border-gray-300 rounded-lg mt-1" required>
                    </div>
                    <div class="flex mt-8 items-center justify-between">
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-lg w-full hover:bg-green-800 text-xl font-semibold">Daftar</button>
                    </div>
                </form>
                <p class="mt-4 text-center text-gray-400">
                    Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-green-600 font-semibold underline hover:text-green-800">Masuk
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
