@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Add Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Shop Owner</label>
            <select name="shop_owner_id" class="form-select" required>
                <option value="">Select Shop Owner</option>
                @foreach($shopOwners as $owner)
                    <option value="{{ $owner->id }}" {{ old('shop_owner_id') == $owner->id ? 'selected' : '' }}>
                        {{ $owner->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" value="{{ old('brand') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Model Name</label>
            <input type="text" name="model_name" value="{{ old('model_name') }}" class="form-control">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" value="{{ old('category', 'laptop') }}" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Operating System</label>
            <input type="text" name="operating_system" value="{{ old('operating_system') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Add Product</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
