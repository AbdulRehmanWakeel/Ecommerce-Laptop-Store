@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold">Edit Order #{{ $order->id }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Customer</label>
            <select name="customer_id" class="form-control" required>
                <option value="">Select Customer</option>
                @foreach(\App\Models\Customer::all() as $customer)
                    <option value="{{ $customer->id }}" {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
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
                        <th>Variant (optional)</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>
                            <button type="button" class="btn btn-success btn-sm" id="add-item">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $index => $item)
                    <tr>
                        <td>
                            <select name="order_items[{{ $index }}][product_id]" class="form-control product-select" required>
                                <option value="">Select Product</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="order_items[{{ $index }}][variant_id]" class="form-control variant-select">
                                <option value="">Select Variant</option>
                            </select>
                        </td>
                        <td><input type="number" name="order_items[{{ $index }}][quantity]" class="form-control quantity" min="1" value="{{ $item->quantity }}" required></td>
                        <td><input type="number" step="0.01" name="order_items[{{ $index }}][price]" class="form-control price" min="0" value="{{ $item->price }}" required></td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-item">-</button></td>
                    </tr>
                    @endforeach
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
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
let index = {{ $order->orderItems->count() }};

const products = @json(\App\Models\Product::with('variants')->get());

function updateVariantOptions(row, selectedVariant = null) {
    const productId = row.querySelector('.product-select').value;
    const variantSelect = row.querySelector('.variant-select');
    variantSelect.innerHTML = '<option value="">Select Variant</option>';

    const product = products.find(p => p.id == productId);
    if(product && product.variants.length) {
        product.variants.forEach(v => {
            const option = document.createElement('option');
            option.value = v.id;
            option.textContent = `${v.processor}, ${v.ram} RAM, ${v.storage}`;
            if(selectedVariant && selectedVariant == v.id) option.selected = true;
            variantSelect.appendChild(option);
        });
    }
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#order-items-table tbody tr').forEach(row => {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        total += qty * price;
    });
    document.getElementById('total_amount').value = total.toFixed(2);
}

document.querySelectorAll('#order-items-table tbody tr').forEach((row, i) => {
    const productSelect = row.querySelector('.product-select');
    const selectedVariant = @json($order->orderItems->pluck('variant_id'))[i];
    updateVariantOptions(row, selectedVariant);

    productSelect.addEventListener('change', () => updateVariantOptions(row));

    row.querySelectorAll('.quantity, .price').forEach(input => input.addEventListener('input', calculateTotal));
    row.querySelector('.remove-item').addEventListener('click', () => {
        if(document.querySelectorAll('#order-items-table tbody tr').length > 1) row.remove();
        calculateTotal();
    });
});

document.getElementById('add-item').addEventListener('click', () => {
    const tbody = document.querySelector('#order-items-table tbody');
    const newRow = tbody.rows[0].cloneNode(true);

    newRow.querySelectorAll('select, input').forEach(input => {
        const name = input.getAttribute('name');
        input.setAttribute('name', name.replace(/\d+/, index));
        if(input.type === 'number') input.value = input.name.includes('quantity') ? 1 : 0;
        else if(input.tagName === 'SELECT') input.selectedIndex = 0;
    });

    newRow.querySelector('.product-select').addEventListener('change', () => updateVariantOptions(newRow));
    newRow.querySelectorAll('.quantity, .price').forEach(input => input.addEventListener('input', calculateTotal));
    newRow.querySelector('.remove-item').addEventListener('click', () => {
        if(document.querySelectorAll('#order-items-table tbody tr').length > 1) newRow.remove();
        calculateTotal();
    });

    tbody.appendChild(newRow);
    index++;
    calculateTotal();
});

window.addEventListener('load', calculateTotal);
</script>
@endsection
