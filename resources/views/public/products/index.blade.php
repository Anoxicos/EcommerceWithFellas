@extends('layouts.app')
@section('title', 'Catalogue')
@section('styles')
    <style>
        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .top h1 {
            font-size: 26px;
            font-weight: 800;
        }

        .top h1 span {
            font-size: 15px;
            color: #64748b;
            font-weight: 400;
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            background: #fff;
            padding: 16px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            margin-bottom: 28px;
        }

        .filters input,
        .filters select {
            padding: 8px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        .filters input {
            flex: 1;
            min-width: 180px;
        }

        .filters .btn {
            padding: 8px 20px;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .filters .reset {
            padding: 8px 14px;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 8px;
            font-size: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 22px;
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-direction: column;
            transition: box-shadow .2s;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card .no-img {
            height: 200px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }

        .card .body {
            padding: 16px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cat {
            font-size: 11px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
        }

        .card h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 6px 0 8px;
        }

        .card p {
            font-size: 13px;
            color: #64748b;
            flex: 1;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price {
            font-size: 20px;
            font-weight: 900;
            color: #6366f1;
        }

        .stock-ok {
            font-size: 13px;
            color: #16a34a;
            font-weight: 600;
        }

        .stock-out {
            font-size: 13px;
            color: #dc2626;
            font-weight: 600;
        }

        .stars {
            font-size: 13px;
            color: #f59e0b;
            margin-bottom: 12px;
        }

        .btn-detail {
            display: block;
            text-align: center;
            background: #6366f1;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .empty {
            grid-column: 1/-1;
            text-align: center;
            padding: 64px;
            color: #94a3b8;
        }
    </style>
@endsection

@section('content')
    <div class="top">
        <h1>Catalogue <span>({{ $products->total() }} produits)</span></h1>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="filters">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Rechercher...">
        <select name="category">
            <option value="">Toutes les catégories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }} ({{ $cat->products_count }})
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn">Filtrer</button>
        @if (request()->hasAny(['search', 'category']))
            <a href="{{ route('products.index') }}" class="reset">✕ Réinitialiser</a>
        @endif
    </form>

    <div class="grid">
        @forelse($products as $product)
            <div class="card">
                @if ($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                @else
                    <div class="no-img">📦</div>
                @endif
                <div class="body">
                    <div class="cat">{{ $product->category->name }}</div>
                    <h3>{{ $product->name }}</h3>
                    <p>{{ Str::limit($product->description, 80) }}</p>
                    <div class="row">
                        <span class="price">{{ number_format($product->price, 2) }} €</span>
                        <span class="{{ $product->stock > 0 ? 'stock-ok' : 'stock-out' }}">
                            {{ $product->stock > 0 ? '✅ ' . $product->stock : '❌ Rupture' }}
                        </span>
                    </div>
                    <div class="stars">
                        @php $r = $product->averageRating(); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            {{ $i <= $r ? '★' : '☆' }}
                        @endfor
                        <span style="color:#64748b">({{ $product->reviews->count() }})</span>
                    </div>
                    <a href="{{ route('products.show', $product) }}" class="btn-detail">
                        Voir le produit →
                    </a>
                </div>
            </div>
        @empty
            <div class="empty">
                <div style="font-size:48px;margin-bottom:16px">🔍</div>
                <p>Aucun produit trouvé.</p>
                <a href="{{ route('products.index') }}" style="color:#6366f1">Voir tout</a>
            </div>
        @endforelse
    </div>

    <div style="margin-top:32px">{{ $products->links() }}</div>
@endsection
