@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <select name="shop_owner_id" class="form-select">
                    <option value="">All Shop Owners</option>
                    @foreach($shopOwners as $owner)
                        <option value="{{ $owner->id }}" {{ request('shop_owner_id') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-secondary w-100">Filter</button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Category</th>
                        <th>OS</th>
                        <th>Shop Owner</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="50" class="rounded">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->brand ?? '-' }}</td>
                            <td>{{ $product->model_name }}</td>
                            <td>
                                @if($product->category === 'laptop')
                                    <span class="badge bg-primary">Laptop</span>
                                @else
                                    <span class="badge bg-secondary">{{ $product->category }}</span>
                                @endif
                            </td>
                            <td>{{ $product->operating_system ?? '-' }}</td>
                            <td>{{ $product->shopOwner->name ?? '-' }}</td>
                            <td>
                                @if($product->has_variants)
                                    ${{ number_format($product->min_price, 2) }} - ${{ number_format($product->max_price, 2) }}
                                @else
                                    ${{ number_format($product->price, 2) }}
                                @endif
                            </td>
                            <td>
                                @if($product->has_variants)
                                    {{ $product->variants->sum('stock') }}
                                @else
                                    {{ $product->stock }}
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning me-1">Edit</a>

                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this product?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>

                                <a href="{{ route('products.variants.index', $product) }}" class="btn btn-sm btn-info ms-1">
                                    @if($product->has_variants)
                                        View Variants
                                    @else
                                        Add Variants
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4 text-muted">No Products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
