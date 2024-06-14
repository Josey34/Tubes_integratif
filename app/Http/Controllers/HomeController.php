<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $newskey = env('NEWS_API_KEY');
        $response = Http::get('https://newsdata.io/api/1/news?apikey=' . $newskey . '&q=sayuran%20sehat%20buah&language=id&size=4');
        $news = $response->json();
        $newsdata = $news['results'];

        $products = [];  // Initialize the products variable

        try {
            $storedToken = session()->get('token');
            Log::info('Token Retrieved:', ['token' => $storedToken]);

            if (!$storedToken) {
                Log::warning('Token is not set in the session.');

                $products = Product::all();
                return view('index', compact('newsdata', 'products'));
            }

            $response = Http::withToken($storedToken)->get('http://127.0.0.1:8001/api/products');

            if ($response->successful()) {
                $productsResponse = $response->json();
                Log::info('API Products Response:', $productsResponse);
                $products = $productsResponse['products']['data'];
            } else {
                Log::error('API Products Error:', ['status' => $response->status(), 'body' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('API Products Exception:', ['error' => $e->getMessage()]);
        }

        return view('index', compact('newsdata', 'products'));
    }
}

//ini yg belum jadi punya azza

// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use App\Models\Product;

// class HomeController extends Controller
// {
//     public function index(Request $request)
//     {
//         $newskey = env('NEWS_API_KEY');
//         $response = Http::get('https://newsdata.io/api/1/news?apikey=' . $newskey . '&q=sayuran%20sehat%20buah&language=id&size=4');
//         $news = $response->json();
//         $newsdata = $news['results'];

//         $products = Product::orderBy('created_at', 'desc')->take(4)->get();


//         try {

//             // Mengirim permintaan GET ke API
//             $token = session()->get('token');
//             ; // Ganti dengan token yang sebenarnya

//             $response = Http::withToken($token)->get('http://127.0.0.1:8001/api/products');

//             // Memeriksa apakah respons sukses
//             if ($response->successful()) {
//                 // Mengambil data dari respons
//                 $products = $response->json();
//                 $products = $products['products']['data'];
//             } else {
//                 // Menangani kesalahan respons
//                 $products = [];
//                 // Anda bisa menambahkan pesan kesalahan atau log disini
//             }
//         } catch (\Exception $e) {
//             // Menangani kesalahan koneksi atau permintaan
//             $products = [];
//             // Anda bisa menambahkan pesan kesalahan atau log disini
//         }

//         return view('index', compact('newsdata', 'products'));
//     }
// }
