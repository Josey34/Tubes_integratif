@extends('layouts.main')

@section('container')
    <div class="container">
        <h1>Payment</h1>
        <div class="card m-3" style="width: 18rem;">
            @if ($order->product)
                <img src="{{ url('/storage/' . $order->product->image) }}" alt="Card image cap" class="card-img-top">
            @else
                <p>No product image available</p>
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $order->product_name }}</h5>
                <p class="card-text">Quantity: {{ $order->quantity }}</p>
                <p class="card-text">Total Payment: Rp {{ $order->total }}</p>
                <p class="card-text">Payment Method: {{ $order->payment }}</p>
            </div>

            <div class="card m-3" style="width: 18rem;">
                @if (isset($ongkir) && count($ongkir['results']) > 0)
                    <h2>Shipping Cost</h2>
                    @foreach ($ongkir['results'] as $result)
                        @if ($result['code'] == $order->courier)
                            @foreach ($result['costs'] as $cost)
                                <p>{{ $cost['service'] }}: Rp {{ $cost['cost'][0]['value'] }} (Estimated:
                                    {{ $cost['cost'][0]['etd'] }} days)</p>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>

            <!-- Add a form to select the service type -->
            <form action="{{ route('hitungOngkir') }}" method="post">
                @csrf
                <select name="service">
                    @foreach ($ongkir['results'] as $result)
                        @if ($result['code'] == $order->courier)
                            @foreach ($result['costs'] as $cost)
                                <option value="{{ $cost['service'] }}">{{ $cost['service'] }} (Rp
                                    {{ $cost['cost'][0]['value'] }})</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>
                <button type="submit">Update Ongkir</button>
            </form>
        </div>
    @endsection
