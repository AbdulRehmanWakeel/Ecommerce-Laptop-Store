@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Shop Owners</h2>
        <a href="{{ route('shop-owners.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle"></i> Add Shop Owner
        </a>
    </div>

    <form method="GET" action="{{ route('shop-owners.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search by name or email..." value="{{ request('q') }}">
            <button class="btn btn-outline-secondary">Search</button>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Shop Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shopOwners as $owner)
                        <tr>
                            <td>{{ $owner->id }}</td>
                            <td>{{ $owner->name }}</td>
                            <td>{{ $owner->email }}</td>
                            <td>{{ $owner->shop_name }}</td>
                            <td class="text-center">
                                <a href="{{ route('shop-owners.edit', $owner) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('shop-owners.destroy', $owner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this shop owner?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No Shop Owners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $shopOwners->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
