<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $va = '0000003192777446';
        $apiKey = 'SANDBOX40CB882E-B91F-4E2A-BCA9-AF9C0D7A0BB9';
        $url = 'https://sandbox.ipaymu.com/api/v2/payment';
        $method = 'POST';

        $products = $request->input('products', ['default_product']);
        $quantities = $request->input('quantities', [1]);
        $prices = $request->input('prices', [1000]);

        $body = [
            'product' => $products,
            'qty' => $quantities,
            'price' => $prices,
            'returnUrl' => $request->input('returnUrl', 'http://example.com/return'),
            'cancelUrl' => $request->input('cancelUrl', 'http://example.com/cancel'),
            'notifyUrl' => $request->input('notifyUrl', 'http://example.com/notify'),
            'referenceId' => $request->input('referenceId', 'default_reference')
        ];

        $jsonBody = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp = now()->format('YmdHis');

        $client = new Client();
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => $headers,
                'body' => $jsonBody
            ]);

            $ret = json_decode($response->getBody()->getContents());

            if ($ret && $ret->Status == 200) {
                $sessionId = $ret->Data->SessionID;
                $url = $ret->Data->Url;
                return redirect($url);
            } else {
                return response()->json($ret);
            }
        } catch (RequestException $e) {
            return response()->json(['error' => 'HTTP Request Error: ' . $e->getMessage()], 500);
        }
    }

    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('orders.show', compact('order'));
    }

    public function cancel($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->status) {
            return redirect()->route('orders.show', $orderId)->withErrors(['order' => 'Order cannot be cancelled as it is already completed.']);
        }

        DB::transaction(function () use ($order) {
            $product = $order->product;
            $product->increment('stock', $order->quantity);

            $order->delete();
        });

        return redirect()->route('home')->with('success', 'Order cancelled successfully.');
    }

    public function notify(Request $request)
    {
        $referenceId = $request->input('referenceId');
        $status = $request->input('status'); // Expected values: 'success', 'failed', etc.

        $order = Order::findOrFail($referenceId);

        if ($status === 'success') {
            $order->update(['status' => true]);
        } else {
            $order->update(['status' => false]);
        }

        return response()->json(['message' => 'Notification received'], 200);
    }



}
