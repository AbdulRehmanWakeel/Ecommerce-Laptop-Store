@extends('layouts.app')

@section('title', 'Variants for ' . $product->name)

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Variants for "{{ $product->name }}"</h2>
        <a href="{{ route('products.variants.create', $product) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Add Variant
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>SKU</th>
                        <th>Processor</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>Graphics Card</th>
                        <th>Display</th>
                        <th>Resolution</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($variants as $variant)
                        <tr>
                            <td>{{ $variant->id }}</td>
                            <td>{{ $variant->sku ?? '-' }}</td>
                            <td>{{ $variant->processor }}</td>
                            <td>{{ $variant->ram }}</td>
                            <td>{{ $variant->storage }}</td>
                            <td>{{ $variant->graphics_card ?? '-' }}</td>
                            <td>{{ $variant->display_size }}</td>
                            <td>{{ $variant->resolution }}</td>
                            <td>{{ $variant->stock }}</td>
                            <td>${{ number_format($variant->price, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('products.variants.edit', [$product, $variant]) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('products.variants.destroy', [$product, $variant]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this variant?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-muted">No Variants found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $variants->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
