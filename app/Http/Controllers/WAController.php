<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('consultation.index');
    }

    public function redirectToWhatsApp()
    {
        $phoneNumber = '6281337196790';
        $message = urlencode('Hello Admin, Saya sangat tertarik dan ingin melakukan konsultasi terkait dengan produk RooftopMart.');
        $url = "https://wa.me/{$phoneNumber}?text={$message}";

        return redirect($url);
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
