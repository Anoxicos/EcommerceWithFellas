@extends('layouts.app')
@section('title', 'Créer un produit')

@section('content')
<div class="container">
    <h1>Nouveau Produit</h1>

    <form method="POST" action="{{ route('admin.products.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div>
            <label>Nom *</label>
            <input type="text" name="name"
                   value="{{ old('name') }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label>Prix (€) *</label>
            <input type="number" name="price" step="0.01"
                   value="{{ old('price') }}" required>
            @error('price') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Stock *</label>
            <input type="number" name="stock"
                   value="{{ old('stock', 0) }}" required>
        </div>

        <div>
            <label>Catégorie *</label>
            <select name="category_id" required>
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Images (plusieurs possibles)</label>
            <input type="file" name="images[]"
                   multiple accept="image/*">
        </div>

        <button type="submit">Créer le produit</button>
        <a href="{{ route('admin.products.index') }}">Annuler</a>
    </form>
</div>
@endsection