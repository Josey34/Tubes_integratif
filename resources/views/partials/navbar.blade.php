<nav class="sticky top-0">
    <div class="py-10 px-28 bg-white border-b-2 border-gray-200  flex items-center justify-between">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/RooftopMart..png') }}" alt="RooftopMart Logo" class="h-8">
        </a>
        <ul class="flex items-center justify-between">
            <li class="mr-10">
                <a href="{{ route('home') }}"
                    class="{{ Route::currentRouteNamed('home') ? 'text-green-600 text-xl font-semibold' : 'text-gray-500 text-xl' }}">Beranda</a>
            </li>
            <li class="mr-10">
                <a href="{{ route('product.index') }}"
                    class="{{ Route::currentRouteNamed('product.index') ? 'text-green-600 text-xl font-semibold' : 'text-gray-500 text-xl' }}">Produk</a>
            </li>
            <li class="mr-10">
                <a href="{{ route('customer.service') }}"
                    class="{{ Route::currentRouteNamed('customer.service') ? 'text-green-600 text-xl font-semibold' : 'text-gray-500 text-xl' }}">Customer
                    Service</a>
            </li>
            <li class="mr-10">
                <a href="{{ route('news.index') }}"
                    class="{{ Route::currentRouteNamed('news.index') ? 'text-green-600 text-xl font-semibold' : 'text-gray-500 text-xl' }}">Blog
                    & Artikel</a>
            </li>
        </ul>
        <div class="w-60 flex justify-between">
            @auth
                <form action="/logout" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-danger" type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="px-6 py-3 bg-white border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-800 hover:border-green-800 hover:text-white text-xl font-semibold">Masuk</a>
                <a href="{{ route('register') }}"
                    class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-800 text-xl font-semibold">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/">E-Commerce</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Others
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/orders">Order</a></li>
                        <li><a class="dropdown-item" href="/product">Products</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    @auth
        <form action="/logout" method="POST" class="d-flex">
            @csrf
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    @else
        <form action="/login" method="GET" class="d-flex">
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    @endauth
</nav> --}}
