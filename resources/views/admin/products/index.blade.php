@extends('layouts.app')
@section('title', 'Admin — Produits')

@section('content')
<div class="container">
    <div style="display:flex; justify-content:space-between; align-items:center">
        <h1>Gestion des Produits</h1>
        <a href="{{ route('admin.products.create') }}">+ Nouveau produit</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->images->first())
                        <img src="{{ asset('storage/' . $product->images->first()->path) }}"
                             width="60" height="60" style="object-fit:cover">
                    @else
                        —
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ number_format($product->price, 2) }} €</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}">Modifier</a>

                    <form method="POST"
                          action="{{ route('admin.products.destroy', $product) }}"
                          onsubmit="return confirm('Supprimer ce produit ?')"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
@endsection