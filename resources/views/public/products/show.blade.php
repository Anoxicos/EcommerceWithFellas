@extends('layouts.app')
@section('title', $product->name)
@section('styles')
    <style>
        .back {
            color: #6366f1;
            font-size: 14px;
            display: inline-block;
            margin-bottom: 24px;
        }

        .detail {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 48px;
        }

        .main-img {
            width: 100%;
            border-radius: 12px;
            object-fit: cover;
            max-height: 420px;
        }

        .thumbs {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            flex-wrap: wrap;
        }

        .thumbs img {
            width: 76px;
            height: 76px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            cursor: pointer;
        }

        .no-img {
            height: 420px;
            background: #f1f5f9;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 64px;
        }

        .cat-badge {
            font-size: 12px;
            font-weight: 700;
            color: #6366f1;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .info h1 {
            font-size: 30px;
            font-weight: 900;
            color: #1e293b;
            margin: 8px 0 12px;
        }

        .stars {
            color: #f59e0b;
            font-size: 17px;
            margin-bottom: 16px;
        }

        .stars span {
            color: #64748b;
            font-size: 14px;
        }

        .desc {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 24px;
            font-size: 15px;
        }

        .price {
            font-size: 36px;
            font-weight: 900;
            color: #6366f1;
            margin-bottom: 14px;
        }

        .stock-pill {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .stock-ok {
            background: #dcfce7;
            color: #16a34a;
        }

        .stock-out {
            background: #fee2e2;
            color: #dc2626;
        }

        .reviews-section {
            border-top: 1px solid #e2e8f0;
            padding-top: 40px;
        }

        .reviews-section h2 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 24px;
        }

        .review {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px;
            background: #f8fafc;
            margin-bottom: 14px;
        }

        .review-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .review-meta strong {
            color: #1e293b;
        }

        .review p {
            color: #475569;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        .review-form {
            background: #f0f4ff;
            border: 1px solid #c7d2fe;
            border-radius: 10px;
            padding: 24px;
            margin-top: 24px;
        }

        .review-form h3 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 14px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-group select,
        .form-group textarea {
            padding: 9px 14px;
            border: 1px solid #c7d2fe;
            border-radius: 8px;
            font-size: 14px;
            background: #fff;
            width: 100%;
            outline: none;
        }

        .btn-review {
            background: #6366f1;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .login-prompt {
            text-align: center;
            padding: 24px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            margin-top: 24px;
        }

        @media(max-width:720px) {
            .detail {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endsection

@section('content')
    <a href="{{ route('products.index') }}" class="back">← Retour au catalogue</a>

    <div class="detail">
        <div>
            @if ($product->images->first())
                <img class="main-img" src="{{ asset('storage/' . $product->images->first()->path) }}" alt="{{ $product->name }}">
                @if ($product->images->count() > 1)
                    <div class="thumbs">
                        @foreach ($product->images->skip(1) as $img)
                            <img src="{{ asset('storage/' . $img->path) }}" alt="">
                        @endforeach
                    </div>
                @endif
            @else
                <div class="no-img">📦</div>
            @endif
        </div>

        <div class="info">
            <div class="cat-badge">{{ $product->category->name }}</div>
            <h1>{{ $product->name }}</h1>

            @php $avg = $product->averageRating(); @endphp
            <div class="stars">
                @for ($i = 1; $i <= 5; $i++)
                    {{ $i <= $avg ? '★' : '☆' }}
                @endfor
                <span>{{ $avg }}/5 — {{ $product->reviews->count() }} avis</span>
            </div>

            <p class="desc">{{ $product->description ?? 'Aucune description.' }}</p>

            <div class="price">{{ number_format($product->price, 2) }} €</div>

            <span class="stock-pill {{ $product->stock > 0 ? 'stock-ok' : 'stock-out' }}">
                {{ $product->stock > 0 ? '✅ En stock — ' . $product->stock . ' dispo.' : '❌ Rupture de stock' }}
            </span>

            <div style="font-size:13px; color:#94a3b8">
                Ajouté le {{ $product->created_at->format('d/m/Y') }}
            </div>
        </div>
    </div>

    <div class="reviews-section">
        <h2>💬 Avis clients ({{ $product->reviews->count() }})</h2>

        @forelse($product->reviews as $review)
            <div class="review">
                <div class="review-meta">
                    <strong>{{ $review->user->name }}</strong>
                    <div>
                        <span style="color:#f59e0b">
                            @for ($i = 1; $i <= 5; $i++)
                                {{ $i <= $review->rating ? '★' : '☆' }}
                            @endfor
                        </span>
                        <span style="color:#94a3b8; font-size:12px; margin-left:8px">
                            {{ $review->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @if ($review->comment)
                    <p>{{ $review->comment }}</p>
                @endif
            </div>
        @empty
            <p style="color:#94a3b8; text-align:center; padding:20px">
                Aucun avis. Soyez le premier !
            </p>
        @endforelse

        @auth
            <div class="review-form">
                <h3>✍️ Laisser un avis</h3>
                <form method="POST" action="{{ route('products.review', $product) }}">
                    @csrf
                    <div class="form-group">
                        <label>Note *</label>
                        <select name="rating" required style="width:auto">
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ str_repeat('★', $i) }} {{ $i }}/5</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Commentaire</label>
                        <textarea name="comment" rows="4" placeholder="Votre avis...">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit" class="btn-review">Publier mon avis</button>
                </form>
            </div>
        @else
            <div class="login-prompt">
                <p style="color:#64748b; margin-bottom:12px">Connectez-vous pour laisser un avis.</p>
                <a href="{{ route('login') }}"
                    style="background:#6366f1; color:#fff; padding:8px 20px;
                  border-radius:8px; font-size:14px; font-weight:600">
                    Se connecter
                </a>
            </div>
        @endauth
    </div>
@endsection
