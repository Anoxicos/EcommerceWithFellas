@extends('layouts.app')
@section('title', 'Admin — Utilisateurs')
@section('styles')
    <style>
        h1 {
            font-size: 26px;
            font-weight: 800;
            margin-bottom: 24px;
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
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr.suspended {
            opacity: .65;
            background: #fff5f5;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-suspended {
            background: #fee2e2;
            color: #dc2626;
        }

        .btn-green {
            padding: 6px 14px;
            background: #dcfce7;
            color: #16a34a;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-red {
            padding: 6px 14px;
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
    <h1>Utilisateurs</h1>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="{{ $user->is_suspended ? 'suspended' : '' }}">
                        <td style="font-weight:600">{{ $user->name }}</td>
                        <td style="color:#64748b; font-size:14px">{{ $user->email }}</td>
                        <td>
                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.role', $user) }}">
                                    @csrf @method('PATCH')
                                    <select name="role" onchange="this.form.submit()"
                                        style="padding:5px 10px; border:1px solid #e2e8f0;
                                       border-radius:6px; font-size:13px; background:#fff">
                                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>👤 Customer
                                        </option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>⚙️ Admin
                                        </option>
                                    </select>
                                </form>
                            @else
                                <span class="badge" style="background:#dbeafe; color:#1d4ed8">⚙️ Admin (vous)</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $user->is_suspended ? 'badge-suspended' : 'badge-active' }}">
                                {{ $user->is_suspended ? '🚫 Suspendu' : '✅ Actif' }}
                            </span>
                        </td>
                        <td>
                            @if ($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="{{ $user->is_suspended ? 'btn-green' : 'btn-red' }}">
                                        {{ $user->is_suspended ? '✅ Réactiver' : '🚫 Suspendre' }}
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top:24px">{{ $users->links() }}</div>
@endsection
