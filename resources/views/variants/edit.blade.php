@extends('layouts.app')

@section('title', 'Edit Variant for ' . $product->name)

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Edit Variant for "{{ $product->name }}"</h2>

    <form action="{{ route('products.variants.update', [$product, $variant]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">SKU (Optional)</label>
                <input type="text" name="sku" value="{{ old('sku', $variant->sku) }}" class="form-control @error('sku') is-invalid @enderror">
                @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Processor</label>
                <input type="text" name="processor" value="{{ old('processor', $variant->processor) }}" class="form-control @error('processor') is-invalid @enderror" required>
                @error('processor') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">RAM</label>
                <input type="text" name="ram" value="{{ old('ram', $variant->ram) }}" class="form-control @error('ram') is-invalid @enderror" required>
                @error('ram') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Storage</label>
                <input type="text" name="storage" value="{{ old('storage', $variant->storage) }}" class="form-control @error('storage') is-invalid @enderror" required>
                @error('storage') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Graphics Card (Optional)</label>
                <input type="text" name="graphics_card" value="{{ old('graphics_card', $variant->graphics_card) }}" class="form-control @error('graphics_card') is-invalid @enderror">
                @error('graphics_card') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Display Size</label>
                <input type="text" name="display_size" value="{{ old('display_size', $variant->display_size) }}" class="form-control @error('display_size') is-invalid @enderror" required>
                @error('display_size') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Resolution</label>
                <input type="text" name="resolution" value="{{ old('resolution', $variant->resolution) }}" class="form-control @error('resolution') is-invalid @enderror" required>
                @error('resolution') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $variant->stock) }}" class="form-control @error('stock') is-invalid @enderror" min="0" required>
                @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Price</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $variant->price) }}" class="form-control @error('price') is-invalid @enderror" min="0" required>
                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Variant</button>
        <a href="{{ route('products.variants.index', $product) }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
