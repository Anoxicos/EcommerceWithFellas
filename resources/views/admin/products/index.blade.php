@extends('layouts.app')

@section('content')
    <h1>Products</h1>

    <a href="{{ route('admin.products.create') }}">Add Product</a>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price (MAD)</th>
                <th>Stock</th>
                <th>Primary Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '—' }}</td>
                <td>{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    @if($product->primaryImage)
                        <img src="{{ asset('storage/'.$product->primaryImage->path) }}" width="80" alt="Primary Image">
                    @endif
                </td>
                <td>
                    {{-- Delete form --}}
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">No products found.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    {{ $products->links() }}
@endsection
