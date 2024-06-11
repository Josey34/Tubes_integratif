@extends('layouts.main')

@section('container')
    <h1>Order Details</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>Address To</th>
            <td>{{ $order->address_to }}</td>
        </tr>
        <tr>
            <th>Courier</th>
            <td>{{ $order->courier }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $order->quantity }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ $order->total }}</td>
        </tr>
        <tr>
            <th>Payment</th>
            <td>{{ $order->payment }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $order->status }}</td>
        </tr>
    </table>
    {{-- <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning">Edit Order</a> --}}
    {{-- <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete Order</button>
    </form>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a> --}}
@endsection
