<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $ordersRaw = DB::table('orders')
                ->orderBy('created_at', 'desc')
                ->paginate(10);

            // Decode items for each order
            $ordersRaw->getCollection()->transform(function ($order) {
                $order->items = json_decode($order->items, true);
                // If double-encoded
                if (is_string($order->items)) {
                    $order->items = json_decode($order->items, true);
                }
                return $order;
            });

            return view('ManageOrders', compact('ordersRaw'));
        } catch (\Exception $e) {
            \Log::error('Error fetching orders: ' . $e->getMessage());
            return view('ManageOrders', ['ordersRaw' => collect()]);
        }
    }

    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'progress_status' => 'required|in:pending,prepping,accepted,out_for_delivery,completed,cancelled'
        ]);

        try {
            // Get current order
            $order = DB::table('orders')->where('order_id', $orderId)->first();

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Get existing timeline or create new array
            $timeline = $order->progress_timeline ? json_decode($order->progress_timeline, true) : [];

            // Add new status change to timeline
            $timeline[] = [
                'status' => $request->progress_status,
                'timestamp' => now()->toIso8601String(),
                'date' => now()->format('Y-m-d H:i:s'),
                'updated_by' => auth()->user()->name ?? 'Admin',
                'user_id' => auth()->id()
            ];

            // Update order
            $updated = DB::table('orders')
                ->where('order_id', $orderId)
                ->update([
                    'progress_status' => $request->progress_status,
                    'progress_timeline' => json_encode($timeline),
                    'updated_at' => now()
                ]);

            if ($updated) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order status updated successfully',
                    'timeline' => $timeline
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }
        } catch (\Exception $e) {
            \Log::error('Error updating order status: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($orderId)
    {
        $order = DB::table('orders')
            ->where('order_id', $orderId)
            ->first();

        if (!$order) {
            abort(404);
        }

        return view('ManageOrders', compact('order'));
    }
}
