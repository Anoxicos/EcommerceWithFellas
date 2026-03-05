@extends('layouts.app')
@section('title', 'Catalogue Produits')

@section('content')
<div class="container">
    <h1>Nos Produits ({{ $products->total() }} articles)</h1>

    {{-- Category Filter --}}
    <form method="GET" action="{{ route('products.index') }}">
        <select name="category" onchange="this.form.submit()">
            <option value="">Toutes les catégories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <input type="text" name="search"
               placeholder="Rechercher..."
               value="{{ request('search') }}">
        <button type="submit">Filtrer</button>
    </form>

    {{-- Product Grid --}}
    <div class="product-grid">
        @forelse($products as $product)
        <div class="product-card">
            @if($product->images->first())
                <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                     alt="{{ $product->name }}">
            @else
                <div class="no-image">Pas d'image</div>
            @endif

            <h3>{{ $product->name }}</h3>
            <p>{{ $product->category->name }}</p>
            <strong>{{ number_format($product->price, 2) }} €</strong>
            <small>Stock: {{ $product->stock }}</small>
            <p>⭐ {{ $product->averageRating() }}/5</p>

            <a href="{{ route('products.show', $product) }}">Voir détail</a>
        </div>
        @empty
            <p>Aucun produit trouvé.</p>
        @endforelse
    </div>

    {{ $products->withQueryString()->links() }}
</div>
@endsection