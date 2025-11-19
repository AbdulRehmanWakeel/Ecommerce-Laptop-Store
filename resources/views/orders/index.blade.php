@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Orders</h2>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Order
        </a>
    </div>

    <form method="GET" action="{{ route('orders.index') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-control">
                <option value="">All Customers</option>
                @foreach(\App\Models\Customer::all() as $customer)
                    <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-outline-secondary w-100">Filter</button>
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
                        <th>Customer</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td class="text-center">
                                <a href="{{ route('orders.edit', $order) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('orders.destroy', $order) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this order?')" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $orders->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
