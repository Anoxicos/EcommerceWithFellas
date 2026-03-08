<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $query = Product::with(['category', 'images', 'reviews']);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        return view('public.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images', 'reviews.user']);

        return view('public.products.show', compact('product'));
    }

    public function storeReview(Request $request, Product $product)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $product->reviews()->updateOrCreate(
            ['user_id' => Auth::id()],
            ['rating'  => $request->rating, 'comment' => $request->comment]
        );

        return back()->with('success', 'Avis enregistré avec succès !');
    }
}