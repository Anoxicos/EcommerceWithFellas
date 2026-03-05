@extends('layouts.app')
@section('title', 'Modifier — ' . $product->name)

@section('content')
<div class="container">
    <h1>Modifier : {{ $product->name }}</h1>

    {{-- Existing images --}}
    <div class="images-grid">
        @foreach($product->images as $image)
        <div>
            <img src="{{ asset('storage/' . $image->path) }}"
                 width="100" height="100" style="object-fit:cover">

            <form method="POST"
                  action="{{ route('admin.images.destroy', $image) }}"
                  onsubmit="return confirm('Supprimer cette image ?')">
                @csrf
                @method('DELETE')
                <button type="submit">✕</button>
            </form>
        </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('admin.products.update', $product) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label>Nom *</label>
            <input type="text" name="name"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div>
            <label>Description</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label>Prix (€) *</label>
            <input type="number" name="price" step="0.01"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <div>
            <label>Stock *</label>
            <input type="number" name="stock"
                   value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div>
            <label>Catégorie *</label>
            <select name="category_id" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Ajouter des images</label>
            <input type="file" name="images[]" multiple accept="image/*">
        </div>

        <button type="submit">Mettre à jour</button>
        <a href="{{ route('admin.products.index') }}">Annuler</a>
    </form>
</div>
@endsection