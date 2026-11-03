<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display all orders.
     */
    public function index()
    {
        $orders = Order::with('items')
            ->latest()
            ->paginate(15);

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }


    /**
     * Display order details.
     */
    public function show(Order $order)
    {
        $order->load('items.product');

        return view(
            'admin.orders.show',
            compact('order')
        );
    }


    /**
     * Update order status.
     */
    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,confirmed,preparing,ready,out_for_delivery,completed,cancelled',
            ],
        ]);


        $order->update([
            'status' => $validated['status'],
        ]);


        return back()
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }


    /**
     * Update payment status.
     */
    public function updatePaymentStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'payment_status' => [
                'required',
                'in:pending,paid,failed',
            ],
        ]);


        $order->update([
            'payment_status' => $validated['payment_status'],
        ]);


        return back()
            ->with(
                'success',
                'Payment status updated successfully.'
            );
    }
}

