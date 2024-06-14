<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $newskey = env('NEWS_API_KEY');
        $response = Http::get('https://newsdata.io/api/1/news?apikey=' . $newskey . '&q=sayuran%20sehat%20buah&language=id&size=4');
        $news = $response->json();
        $newsdata = $news['results'];

        $products = Product::orderBy('created_at', 'desc')->take(4)->get();


        try {

            // Mengirim permintaan GET ke API
            $token = session()->get('token');
            ; // Ganti dengan token yang sebenarnya

            $response = Http::withToken($token)->get('http://127.0.0.1:8001/api/products');

            // Memeriksa apakah respons sukses
            if ($response->successful()) {
                // Mengambil data dari respons
                $products = $response->json();
                $products = $products['products']['data'];
            } else {
                // Menangani kesalahan respons
                $products = [];
                // Anda bisa menambahkan pesan kesalahan atau log disini
            }
        } catch (\Exception $e) {
            // Menangani kesalahan koneksi atau permintaan
            $products = [];
            // Anda bisa menambahkan pesan kesalahan atau log disini
        }

        return view('index', compact('newsdata', 'products'));
    }
}
