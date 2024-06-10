@extends('dashboard.layouts.main')

@section('container')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Products</h1>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive col-lg-8">
            <a href="/dashboard/products/create" class="btn btn-primary mb-3">Create new product</a>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="/dashboard/products/{{ $product->id }}" class="badge bg-info"><i
                                        class="bi bi-eye"></i> </a>
                                <a href="/dashboard/products/{{ $product->id }}/edit" class="badge bg-warning"><i
                                        class="bi bi-pencil-fill"></i> </a>
                                <form action="/dashboard/products/{{ $product->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf

                                    <button class="badge bg-danger border-0" onclick="return confirm('Are your sure?')"><i class="bi bi-x-circle"></i> </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
