@extends('layouts.app')
@section('title', 'Admin — Produits')
@section('styles')
    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 26px;
            font-weight: 800;
        }

        .page-header p {
            color: #64748b;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .btn-sec {
            padding: 9px 18px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #475569;
            font-size: 14px;
            background: #fff;
        }

        .btn-prim {
            padding: 9px 18px;
            background: #6366f1;
            color: #fff;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .table-wrap {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f8fafc;
            padding: 11px 16px;
            text-align: left;
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fafafa;
        }

        .thumb {
            width: 52px;
            height: 52px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-thumb {
            width: 52px;
            height: 52px;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-cat {
            background: #ede9fe;
            color: #7c3aed;
        }

        .td-price {
            font-weight: 700;
            color: #6366f1;
        }

        .td-name {
            font-weight: 600;
            color: #1e293b;
        }

        .btn-edit {
            padding: 5px 13px;
            background: #f0f4ff;
            color: #6366f1;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        .btn-del {
            padding: 5px 13px;
            background: #fee2e2;
            color: #dc2626;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="page-header">
        <div>
            <h1>Produits</h1>
            <p>{{ $products->total() }} produits au total</p>
        </div>
        <div class="actions">
            <a href="{{ route('admin.categories.index') }}" class="btn-sec">📁 Catégories</a>
            <a href="{{ route('admin.users.index') }}" class="btn-sec">👥 Utilisateurs</a>
            <a href="{{ route('admin.products.create') }}" class="btn-prim">+ Nouveau produit</a>
        </div>
    </div>

    <div class="table-wrap">
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
                @foreach ($products as $product)
                    <tr>
                        <td>
                            @if ($product->images->first())
                                <img class="thumb" src="{{ asset('storage/' . $product->images->first()->path) }}"
                                    alt="{{ $product->name }}">
                            @else
                                <div class="no-thumb">📦</div>
                            @endif
                        </td>
                        <td class="td-name">{{ $product->name }}</td>
                        <td><span class="badge badge-cat">{{ $product->category->name }}</span></td>
                        <td class="td-price">{{ number_format($product->price, 2) }} €</td>
                        <td style="font-weight:600; color:{{ $product->stock > 0 ? '#16a34a' : '#dc2626' }}">
                            {{ $product->stock }}
                        </td>
                        <td>
                            <div style="display:flex; gap:8px">
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn-edit">✏️ Modifier</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                    onsubmit="return confirm('Supprimer ce produit ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-del">🗑️ Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:24px">{{ $products->links() }}</div>
@endsection
