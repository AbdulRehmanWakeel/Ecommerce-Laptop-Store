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
                    <option value="{{ $customer->id }}" 
                        {{ $order->customer_id == $customer->id ? 'selected' : '' }}>
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

                <tbody id="items-body">
                    @foreach($order->orderItems as $index => $item)
                    <tr>
                        <td>
                            <select name="order_items[{{ $index }}][product_id]" 
                                    class="form-control product-select"
                                    data-selected-variant="{{ $item->variant_id }}" required>
                                <option value="">Select Product</option>
                                @foreach(\App\Models\Product::all() as $product)
                                    <option value="{{ $product->id }}" 
                                        {{ $item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select name="order_items[{{ $index }}][variant_id]" 
                                    class="form-control variant-select">
                                <option value="">Select Variant</option>
                            </select>
                        </td>

                        <td>
                            <input type="number" min="1"
                                   name="order_items[{{ $index }}][quantity]"
                                   class="form-control quantity"
                                   value="{{ $item->quantity }}" required>
                        </td>

                        <td>
                            <input type="number" step="0.01" min="0"
                                   name="order_items[{{ $index }}][price]"
                                   class="form-control price"
                                   value="{{ $item->price }}" required>
                        </td>

                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-btn">-</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="mb-3">
            <label>Total Amount</label>
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

function loadVariants(row, selectedVariant = null) {
    const productId = row.querySelector('.product-select').value;
    const variantSelect = row.querySelector('.variant-select');

    variantSelect.innerHTML = '<option value="">Select Variant</option>';

    const product = products.find(p => p.id == productId);
    if (!product || !product.variants.length) return;

    product.variants.forEach(v => {
        const option = document.createElement('option');
        option.value = v.id;
        option.textContent = `${v.processor}, ${v.ram} RAM, ${v.storage}`;
        if (selectedVariant && selectedVariant == v.id) option.selected = true;
        variantSelect.appendChild(option);
    });
}

function calculateTotal() {
    let total = 0;
    document.querySelectorAll('#items-body tr').forEach(row => {
        const qty = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        total += qty * price;
    });
    document.getElementById('total_amount').value = total.toFixed(2);
}

function attachRowEvents(row) {
    row.querySelector('.product-select').addEventListener('change', () => {
        loadVariants(row);
    });

    row.querySelectorAll('.quantity, .price').forEach(input => {
        input.addEventListener('input', calculateTotal);
    });

    row.querySelector('.remove-btn').addEventListener('click', () => {
        if (document.querySelectorAll('#items-body tr').length > 1)
            row.remove();
        calculateTotal();
    });
}

document.querySelectorAll('#items-body tr').forEach((row) => {
    const selectedVariant = row.querySelector('.product-select').dataset.selectedVariant;
    loadVariants(row, selectedVariant);
    attachRowEvents(row);
});

document.getElementById('add-item').addEventListener('click', () => {
    const tbody = document.getElementById('items-body');

    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <select name="order_items[${index}][product_id]" class="form-control product-select" required>
                <option value="">Select Product</option>
                ${products.map(p => `<option value="${p.id}">${p.name}</option>`).join('')}
            </select>
        </td>
        <td>
            <select name="order_items[${index}][variant_id]" class="form-control variant-select">
                <option value="">Select Variant</option>
            </select>
        </td>
        <td><input type="number" name="order_items[${index}][quantity]" class="form-control quantity" value="1" min="1"></td>
        <td><input type="number" name="order_items[${index}][price]" class="form-control price" value="0" step="0.01" min="0"></td>
        <td><button type="button" class="btn btn-danger btn-sm remove-btn">-</button></td>
    `;

    tbody.appendChild(newRow);
    attachRowEvents(newRow);
    index++;
    calculateTotal();
});

window.addEventListener('load', calculateTotal);
</script>
@endsection
