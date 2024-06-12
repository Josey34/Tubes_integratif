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
        // $products = Product::query();

        return view('index', compact('newsdata', 'products'));
    }
}
