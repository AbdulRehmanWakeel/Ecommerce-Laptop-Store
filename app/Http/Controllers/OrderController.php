<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('customer', 'orderItems.product', 'orderItems.variant')
            ->status($request->status)
            ->ofCustomer($request->customer_id)
            ->latest()
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
            'status' => $request->status ?? 'pending',
            'total_amount' => 0,
        ]);

        foreach ($request->order_items as $item) {
            $order->orderItems()->create($item);
        }

        $order->update(['total_amount' => $order->calculateTotal()]);

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
             'status' => $request->status
        ]);

        if ($request->has('order_items')) {
            foreach ($request->order_items as $itemData) {
                if (isset($itemData['id'])) {
                    $orderItem = $order->orderItems()->find($itemData['id']);
                    if ($orderItem) {
                        $orderItem->update($itemData);
                    }
                } else {
                    $order->orderItems()->create($itemData);
                }
            }
        }

        $order->update(['total_amount' => $order->calculateTotal()]);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }


    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }

    public function destroyItem(OrderItem $orderItem)
    {
        $order = $orderItem->order;
        $orderItem->delete();
        $order->update(['total_amount' => $order->calculateTotal()]);
        return back()->with('success', 'Order item removed.');
    }
}
