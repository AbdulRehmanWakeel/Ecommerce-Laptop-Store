@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold">Create Order</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-control" required>
                <option value="">Select Customer</option>
                @foreach(\App\Models\Customer::all() as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Order Items</label>
            <table class="table table-bordered" id="order-items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>
                            <button type="button" class="btn btn-success btn-sm" id="add-item">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="order_items[0][product_id]" class="form-control" required>
                                <option value="">Select Product</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" name="order_items[0][quantity]" class="form-control quantity" min="1" value="1" required></td>
                        <td><input type="number" step="0.01" name="order_items[0][price]" class="form-control price" min="0" value="0" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-item">-</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <label>Total Amount:</label>
            <input type="text" id="total_amount" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" selected>Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
let index = 1;

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#order-items-table tbody tr').forEach(row => {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        total += qty * price;
    });
    document.getElementById('total_amount').value = total.toFixed(2);
}

document.getElementById('add-item').addEventListener('click', () => {
    const tbody = document.querySelector('#order-items-table tbody');
    const newRow = tbody.rows[0].cloneNode(true);

    newRow.querySelectorAll('select, input').forEach(input => {
        const name = input.getAttribute('name');
        input.setAttribute('name', name.replace(/\d+/, index));

        if(input.type === 'number') {
            input.value = input.name.includes('quantity') ? 1 : 0;
        } else if(input.tagName === 'SELECT') {
            input.selectedIndex = 0;
        } else {
            input.value = '';
        }
    });

    tbody.appendChild(newRow);
    index++;
    calculateTotal();
});

document.querySelector('#order-items-table').addEventListener('click', e => {
    if(e.target.classList.contains('remove-item')) {
        if(document.querySelectorAll('#order-items-table tbody tr').length > 1)
            e.target.closest('tr').remove();
        calculateTotal();
    }
});

document.querySelector('#order-items-table').addEventListener('input', calculateTotal);

window.addEventListener('load', calculateTotal);
</script>
@endsection
