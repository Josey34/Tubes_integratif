<nav class="navbar navbar-expand-lg bg-body-tertiary">
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
            <form class="d-flex" action="{{ route('product.index') }}" method="GET">
                <input class="form-control me-2" type="search" placeholder="Search by name" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
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
</nav>
