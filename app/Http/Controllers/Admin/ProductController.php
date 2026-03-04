<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(20);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $img) {
                $path = $img->store('products', 'public');

                $product->images()->create([
                    'path'       => $path,
                    'is_primary' => ($i === 0),
                ]);
            }
        }

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
        }

        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
