<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newskey = env('NEWS_API_KEY');
        $response = Http::get('https://newsdata.io/api/1/news?apikey=' . $newskey . '&q=sayuran%20sehat%20buah&language=id&size=8');
        $news = $response->json();
        $newsdata = $news['results'];

        return view('news.index', compact('newsdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return abort(404, 'Not Found');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return abort(404, 'Not Found');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return abort(404, 'Not Found');
    }
}
