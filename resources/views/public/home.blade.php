@extends('layouts.app')
@section('title', 'Accueil — ShopB2C')
@section('styles')
    <style>
        .hero {
            text-align: center;
            padding: 56px 0 40px;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: 900;
            color: #1e293b;
            margin-bottom: 12px;
        }

        .hero h1 span {
            color: #6366f1;
        }

        .hero p {
            color: #64748b;
            font-size: 17px;
            margin-bottom: 8px;
        }

        .hero .count {
            color: #6366f1;
            font-size: 20px;
            font-weight: 700;
            margin: 12px 0 24px;
        }

        .hero a {
            display: inline-block;
            background: #6366f1;
            color: #fff;
            padding: 13px 36px;
            border-radius: 9px;
            font-size: 16px;
            font-weight: 700;
            transition: background .2s;
        }

        .hero a:hover {
            background: #4f46e5;
        }

        .section-title {
            font-size: 22px;
            font-weight: 800;
            color: #1e293b;
            margin: 40px 0 24px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: box-shadow .2s;
        }

        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card .no-img {
            height: 180px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .card .body {
            padding: 14px;
        }

        .card .cat {
            font-size: 11px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .card h3 {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 5px 0 10px;
        }

        .card .price {
            font-size: 19px;
            font-weight: 900;
            color: #6366f1;
        }
    </style>
@endsection

@section('content')
    <div class="hero">
        <h1>Bienvenue sur <span>ShopB2C</span></h1>
        <p>Découvrez notre catalogue de produits de qualité</p>
        <p class="count">🛍️ {{ $totalProducts }} produits disponibles</p>
        <a href="{{ route('products.index') }}">Voir le catalogue →</a>
    </div>

    <hr style="border:none; border-top:1px solid #e2e8f0">

    <p class="section-title">🆕 Derniers produits ajoutés</p>

    <div class="grid">
        @foreach ($latestProducts as $product)
            <a href="{{ route('products.show', $product) }}" class="card" style="color:inherit">
                @if ($product->images->first())
                    <img src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                @else
                    <div class="no-img">📦</div>
                @endif
                <div class="body">
                    <div class="cat">{{ $product->category->name }}</div>
                    <h3>{{ $product->name }}</h3>
                    <div class="price">{{ number_format($product->price, 2) }} €</div>
                </div>
            </a>
        @endforeach
    </div>
@endsection
