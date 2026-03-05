<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    // Product listing with category filter
    public function index(Request $request)
    {
        $categories = Category::all();
        $query      = Product::with(['category', 'images', 'reviews']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12);

        return view('public.products.index', compact('products', 'categories'));
    }

    // Single product detail page
    public function show(Product $product)
    {
        $product->load(['category', 'images', 'reviews.user']);

        return view('public.products.show', compact('product'));
    }

    // Submit a review (authenticated users only)
    public function review(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product->reviews()->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'rating'  => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return back()->with('success', 'Avis soumis avec succès !');
    }
}