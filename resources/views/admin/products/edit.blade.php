@extends('layouts.app')
@section('title', 'Modifier — ' . $product->name)
@section('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            max-width: 680px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        input[type=text],
        input[type=number],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #6366f1;
        }

        .row2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .images-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 18px;
            margin-bottom: 24px;
        }

        .images-box h3 {
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 14px;
        }

        .thumbs {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .thumb-wrap {
            position: relative;
        }

        .thumb-wrap img {
            width: 88px;
            height: 88px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }

        .del-img {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 22px;
            height: 22px;
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-input {
            width: 100%;
            padding: 8px;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-footer {
            display: flex;
            gap: 12px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .btn-submit {
            padding: 10px 28px;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel {
            padding: 10px 20px;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 8px;
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <a href="{{ route('admin.products.index') }}" style="color:#6366f1; font-size:14px">← Retour</a>
    <h1 style="font-size:26px; font-weight:800; margin:16px 0 8px">Modifier le produit</h1>
    <p style="color:#64748b; font-size:14px; margin-bottom:28px">{{ $product->name }}</p>

    @if ($product->images->count())
        <div class="images-box">
            <h3>📷 Images actuelles</h3>
            <div class="thumbs">
                @foreach ($product->images as $img)
                    <div class="thumb-wrap">
                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                        <form method="POST" action="{{ route('admin.images.destroy', $img) }}"
                            onsubmit="return confirm('Supprimer ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="del-img">✕</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="form-card">
        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="field">
                <label>Nom *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="row2">
                <div class="field">
                    <label>Prix (€) *</label>
                    <input type="number" name="price" step="0.01" min="0"
                        value="{{ old('price', $product->price) }}" required>
                </div>
                <div class="field">
                    <label>Stock *</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', $product->stock) }}"
                        required>
                </div>
            </div>

            <div class="field">
                <label>Catégorie *</label>
                <select name="category_id" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label>Ajouter des images</label>
                <input type="file" name="images[]" multiple accept="image/*" class="file-input">
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">💾 Enregistrer</button>
                <a href="{{ route('admin.products.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
@endsection
