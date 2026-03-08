@extends('layouts.app')
@section('title', 'Admin — Catégories')
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
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            background: #ede9fe;
            color: #7c3aed;
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
        <h1>Catégories</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn-prim">+ Nouvelle catégorie</a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Produits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                    <tr>
                        <td style="font-weight:600; color:#1e293b">{{ $cat->name }}</td>
                        <td style="color:#64748b; font-size:14px">{{ Str::limit($cat->description, 60) ?? '—' }}</td>
                        <td><span class="badge">{{ $cat->products_count }}</span></td>
                        <td>
                            <div style="display:flex; gap:8px">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn-edit">✏️ Modifier</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}"
                                    onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-del">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:24px">{{ $categories->links() }}</div>
@endsection
