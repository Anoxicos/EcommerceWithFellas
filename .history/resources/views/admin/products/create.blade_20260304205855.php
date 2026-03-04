@extends('layouts.app')

@section('content')
    <h1>Add Product</h1>

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label>Price (MAD):</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" required>
        </div>

        <div>
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ old('stock') }}" required>
        </div>

        <div>
            <label>Category:</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Images:</label>
            <input type="file" name="images[]" multiple>
            <small>First image will be set as primary</small>
        </div>

        <button type="submit">Create Product</button>
    </form>
@endsection
