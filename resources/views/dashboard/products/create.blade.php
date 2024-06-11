@extends('dashboard.layouts.main')

@section('container')

<div class="container">
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Product') }}</div>

                <div class="card-body">
                    <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" name="product_name" placeholder="product_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <input type="text" name="description" placeholder="Description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="price" placeholder="Price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Weight</label>
                            <input type="number" name="weight" placeholder="weight" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="address_from">Asal Kota</label>
                            <select name="address_from" class="form-control">
                                @foreach($cities as $city)
                                    <option value="{{ $city['city_name'] }}">{{ $city['city_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" name="stock" placeholder="Stock" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
