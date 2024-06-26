@extends('dashboard.layouts.main')

@section('container')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
    <div class="container">
        <h1>Edit Product</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="product_name"
                    value="{{ old('product_name', $product->product_name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price"
                    value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="weight">Weight</label>
                <input type="number" name="weight" class="form-control" id="weight"
                    value="{{ old('weight', $product->weight) }}" required>
            </div>

            <div class="form-group">
                <label for="address_from">Asal Kota</label>
                <select name="address_from" class="form-control" id="address_from" required>
                    @foreach ($cities as $city)
                        <option value="{{ $city['city_name'] }}"
                            {{ old('address_from', $product->address_from) == $city['city_name'] ? 'selected' : '' }}>
                            {{ $city['city_name'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" name="stock" class="form-control" id="stock"
                    value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Product Image</label>
                @if ($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail"
                            style="max-width: 200px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control-file" id="image">
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</main>
@endsection
