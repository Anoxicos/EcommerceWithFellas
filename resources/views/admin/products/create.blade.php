@extends('layouts.app')
@section('title', 'Créer un produit')
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
            transition: border .2s;
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

        .file-input {
            width: 100%;
            padding: 8px;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
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
    <h1 style="font-size:26px; font-weight:800; margin:16px 0 28px">Nouveau Produit</h1>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label>Nom du produit *</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="row2">
                <div class="field">
                    <label>Prix (€) *</label>
                    <input type="number" name="price" step="0.01" min="0" value="{{ old('price') }}" required>
                    @error('price')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label>Stock *</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', 0) }}" required>
                </div>
            </div>

            <div class="field">
                <label>Catégorie *</label>
                <select name="category_id" required>
                    <option value="">-- Choisir une catégorie --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label>Images (jpeg, png, webp — max 2MB chacune)</label>
                <input type="file" name="images[]" multiple accept="image/*" class="file-input">
                @error('images.*')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-submit">✅ Créer</button>
                <a href="{{ route('admin.products.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
@endsection
