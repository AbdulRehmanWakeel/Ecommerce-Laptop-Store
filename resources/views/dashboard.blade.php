@extends('layouts.app')

@section('content')
<div class="row g-4">
    <div class="col-12 mb-3">
        <h2 class="fw-bold">Dashboard</h2>
        <p class="text-muted">Overview of your e-commerce laptop store</p>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase fw-bold text-muted">Shop Owners</h6>
                    <i class="bi bi-people fs-3 text-primary"></i>
                </div>
                <h3 class="mt-2">{{ \App\Models\ShopOwner::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase fw-bold text-muted">Customers</h6>
                    <i class="bi bi-person fs-3 text-success"></i>
                </div>
                <h3 class="mt-2">{{ \App\Models\Customer::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase fw-bold text-muted">Products</h6>
                    <i class="bi bi-laptop fs-3 text-warning"></i>
                </div>
                <h3 class="mt-2">{{ \App\Models\Product::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase fw-bold text-muted">Orders</h6>
                    <i class="bi bi-cart fs-3 text-danger"></i>
                </div>
                <h3 class="mt-2">{{ \App\Models\Order::count() }}</h3>
            </div>
        </div>
    </div>

    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Latest Orders</h5>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\Order::latest()->take(5)->get() as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ ucfirst($order->status) }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
