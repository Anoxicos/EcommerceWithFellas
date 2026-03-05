@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container">
    <a href="{{ route('products.index') }}">← Retour</a>

    <div class="product-detail">
        {{-- Images gallery --}}
        <div class="product-images">
            @foreach($product->images as $image)
                <img src="{{ asset('storage/' . $image->path) }}"
                     alt="{{ $product->name }}">
            @endforeach
        </div>

        {{-- Info --}}
        <div class="product-info">
            <h1>{{ $product->name }}</h1>
            <span>{{ $product->category->name }}</span>
            <p>{{ $product->description }}</p>
            <div class="price">{{ number_format($product->price, 2) }} €</div>
            <div>Stock disponible: {{ $product->stock }}</div>
            <div>Note moyenne: ⭐ {{ $product->averageRating() }}/5
                 ({{ $product->reviews->count() }} avis)</div>
        </div>
    </div>

    {{-- Reviews --}}
    <section>
        <h2>Avis clients</h2>

        @foreach($product->reviews as $review)
        <div class="review">
            <strong>{{ $review->user->name }}</strong>
            <span>{{ str_repeat('⭐', $review->rating) }}</span>
            <p>{{ $review->comment }}</p>
            <small>{{ $review->created_at->diffForHumans() }}</small>
        </div>
        @endforeach

        {{-- Submit review --}}
        @auth
        <form method="POST" action="{{ route('products.review', $product) }}">
            @csrf
            <label>Note:
                <select name="rating" required>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐</option>
                    @endfor
                </select>
            </label>
            <textarea name="comment" placeholder="Votre commentaire..."></textarea>
            <button type="submit">Soumettre mon avis</button>
        </form>
        @else
            <p><a href="{{ route('login') }}">Connectez-vous</a> pour laisser un avis.</p>
        @endauth
    </section>
</div>
@endsection