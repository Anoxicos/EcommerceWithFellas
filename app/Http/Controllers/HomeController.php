<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::with(['category', 'images'])
                                  ->latest()
                                  ->take(8)
                                  ->get();

        $totalProducts = Product::count();

        return view('public.home', compact('latestProducts', 'totalProducts'));
    }
}