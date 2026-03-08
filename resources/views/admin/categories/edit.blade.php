@extends('layouts.app')
@section('title', 'Modifier — ' . $category->name)
@section('styles')
    <style>
        .form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
            max-width: 520px;
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

        input,
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
        textarea:focus {
            border-color: #6366f1;
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
    <a href="{{ route('admin.categories.index') }}" style="color:#6366f1; font-size:14px">← Retour</a>
    <h1 style="font-size:26px; font-weight:800; margin:16px 0 28px">Modifier : {{ $category->name }}</h1>

    <div class="form-card">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <div class="field">
                <label>Nom *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="field">
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $category->description) }}</textarea>
            </div>
            <div class="form-footer">
                <button type="submit" class="btn-submit">💾 Enregistrer</button>
                <a href="{{ route('admin.categories.index') }}" class="btn-cancel">Annuler</a>
            </div>
        </form>
    </div>
@endsection
