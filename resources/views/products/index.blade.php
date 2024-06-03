@extends('layouts.main')

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-group m-auto">
                        @foreach ($products as $product)
                            <div class="card m-3" style="width: 18rem;">
                                <img src="{{ url('/storage/' . $product->image) }}" alt="Card image cap" class="card-img-top">
                                <div class="card-body">
                                    <p class="card-text">{{ $product->product_name }}</p>
                                    <form action="{{ route('product.show', $product->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">Show Detail</button>
                                    </form>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger mt-2">Delete Product</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
