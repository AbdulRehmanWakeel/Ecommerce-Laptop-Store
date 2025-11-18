<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
   public function index(Request $request)
    {
        $orders = Order::with('customer', 'orderItems.product')
                        ->status($request->status)
                        ->ofCustomer($request->customer_id)
                        ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');  
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_amount' => collect($request->order_items)->sum(fn($item) => $item['price'] * $item['quantity']),
            'status' => $request->status ?? 'pending'
        ]);

        foreach ($request->order_items as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $order->load('orderItems');
        return view('orders.edit', compact('order'));
    }

    public function update(UpdateOrderRequest $request, Order $order)
    {
        $order->update([
            'customer_id' => $request->customer_id,
            'status' => $request->status,
            'total_amount' => $request->has('order_items') 
                ? collect($request->order_items)->sum(fn($item) => $item['price'] * $item['quantity']) 
                : $order->total_amount
        ]);

        if ($request->has('order_items')) {
            $order->orderItems()->delete();
            foreach ($request->order_items as $item) {
                $order->orderItems()->create($item);
            }
        }

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
