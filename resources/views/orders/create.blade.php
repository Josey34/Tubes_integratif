@extends('layouts.main')

@section('container')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <h1>Create Order</h1>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="address_to">Address To</label>
                    <input type="text" name="address_to" id="address_to" class="form-control" value="{{ old('address_to') }}" required>
                </div>
                <div class="form-group">
                    <label for="courier">Courier</label>
                    <input type="text" name="courier" id="courier" class="form-control" value="{{ old('courier') }}" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}" required>
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total" class="form-control" value="{{ old('total') }}" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="payment">Payment</label>
                    <input type="text" name="payment" id="payment" class="form-control" value="{{ old('payment') }}" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-control" value="{{ old('status') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Order</button>
            </form>
        </div>
    </div>
</div>

@endsection
