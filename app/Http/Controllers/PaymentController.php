<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationMail;
use App\Mail\AdminOrderNotification;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function preparePayment(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
            'delivery_instructions' => 'nullable|string',
            'items' => 'required|array',
            'items.*.id' => 'required',
            'items.*.title' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.image' => 'required|string',
            'amount' => 'required|numeric',
            'currency' => 'required|string'
        ]);

        // Generate unique order ID
        $orderId = 'KL' . Str::uuid();

        // Save order as pending before payment
        $order = new Order();
        $order->order_id = $orderId;
        $order->First_Name = $validated['first_name'];
        $order->Last_Name = $validated['last_name'];
        $order->Email = $validated['email'];
        $order->Phone = $validated['phone'];
        $order->Address = $validated['address'];
        $order->City = $validated['city'];
        $order->State = $validated['state'];
        $order->Zip_Code = $validated['zip_code'];
        $order->Delivery_Instructions = $validated['delivery_instructions'] ?? '';
        $order->amount = $validated['amount'];
        $order->currency = $validated['currency'];
        $order->items = json_encode($validated['items']);
        $order->status = 0; // Pending
        $order->save();

        Log::info('Order created', ['order_id' => $orderId, 'amount' => $validated['amount']]);

        // PayHere integration
        $merchantId = env('PAYHERE_MERCHANT_ID');
        $merchantSecret = env('PAYHERE_MERCHANT_SECRET');

        $amount = number_format($validated['amount'], 2, '.', '');
        $hashedSecret = strtoupper(md5($merchantSecret));
        $hash = strtoupper(md5($merchantId . $orderId . $amount . $validated['currency'] . $hashedSecret));

        $itemsDescription = collect($validated['items'])
            ->map(fn($item) => $item['title'] . ' (x' . $item['quantity'] . ')')
            ->implode(', ');

        return response()->json([
            'orderId' => $orderId,
            'merchantId' => $merchantId,
            'hash' => $hash,
            'amount' => $amount,
            'currency' => $validated['currency'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'country' => 'Sri Lanka',
            'items' => $itemsDescription,
            'delivery_address' => $validated['address'],
            'delivery_city' => $validated['city'],
            'delivery_country' => 'Sri Lanka'
        ]);
    }

    public function PaymentNotify(Request $request)
    {
        // Log ALL incoming data
        Log::info('=== PAYHERE NOTIFY START ===');
        Log::info('PayHere Notify - All POST data:', $request->all());
        Log::info('PayHere Notify - Headers:', $request->headers->all());

        $merchant_id      = $request->post('merchant_id');
        $order_id         = $request->post('order_id');
        $payment_id       = $request->post('payment_id');
        $payhere_amount   = $request->post('payhere_amount');
        $payhere_currency = $request->post('payhere_currency');
        $status_code      = $request->post('status_code');
        $payhere_card_holder_name = $request->post('card_holder_name');
        $payhere_card_no = $request->post('card_no');
        $payhere_card_expiry = $request->post('card_expiry');
        $md5sig_received  = $request->post('md5sig');

        Log::info('Extracted values:', [
            'merchant_id' => $merchant_id,
            'order_id' => $order_id,
            'payment_id' => $payment_id,
            'payhere_amount' => $payhere_amount,
            'status_code' => $status_code,
            'card_holder_name' => $payhere_card_holder_name,
            'card_no' => $payhere_card_no,
            'card_expiry' => $payhere_card_expiry
        ]);

        $merchant_secret = env('PAYHERE_MERCHANT_SECRET');

        // Verify signature
        $local_md5sig = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                $payhere_amount .
                $payhere_currency .
                $status_code .
                strtoupper(md5($merchant_secret))
            )
        );

        Log::info('Signature verification:', [
            'calculated' => $local_md5sig,
            'received' => $md5sig_received,
            'match' => ($local_md5sig === $md5sig_received)
        ]);

        if ($local_md5sig !== $md5sig_received) {
            Log::error('SIGNATURE MISMATCH - Rejecting payment notification');
            return response("Invalid signature", 400);
        }

        // Find the existing order
        Log::info('Looking for order:', ['order_id' => $order_id]);

        $order = Order::where('order_id', $order_id)->first();

        if (!$order) {
            Log::error('ORDER NOT FOUND in database', ['order_id' => $order_id]);
            return response("Order not found", 404);
        }

        Log::info('Order found:', [
            'id' => $order->id,
            'order_id' => $order->order_id,
            'current_status' => $order->status,
            'email' => $order->Email
        ]);

        // Update order with payment details
        $order->status = $status_code == 2 ? 2 : -2;
        $order->payment_id = $payment_id;
        $order->paid_amount = $payhere_amount;
        $order->card_holder_name = $payhere_card_holder_name;
        $order->card_no = $payhere_card_no;
        $order->card_expiry = $payhere_card_expiry;

        Log::info('About to save order with data:', [
            'status' => $order->status,
            'payment_id' => $order->payment_id,
            'paid_amount' => $order->paid_amount,
            'card_holder_name' => $order->card_holder_name,
            'card_no' => $order->card_no,
            'card_expiry' => $order->card_expiry
        ]);

        // Save the order
        try {
            $saved = $order->save();
            Log::info('Order save result:', ['saved' => $saved]);

            // Verify it was saved
            $verifyOrder = Order::where('order_id', $order_id)->first();
            Log::info('Verification after save:', [
                'payment_id' => $verifyOrder->payment_id,
                'paid_amount' => $verifyOrder->paid_amount,
                'status' => $verifyOrder->status,
                'card_holder_name' => $verifyOrder->card_holder_name
            ]);
        } catch (\Exception $e) {
            Log::error('FAILED TO SAVE ORDER:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response("Database error", 500);
        }

        // Process after payment update
        $this->afterPaymentUpdate($order);

        Log::info('=== PAYHERE NOTIFY END ===');
        return response("OK", 200);
    }

    private function afterPaymentUpdate($order)
    {
        Log::info('afterPaymentUpdate called', ['order_id' => $order->order_id, 'status' => $order->status]);

        if ($order->status == 2) {
            Log::info('Payment successful - processing order');

            // Reduce stock
            $this->reduceStock($order);

            // Send confirmation email to customer
            try {
                Log::info('Attempting to send confirmation email to customer:', ['email' => $order->Email]);
                Mail::to($order->Email)->send(new ConfirmationMail($order));
                Log::info('Customer confirmation email SENT successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send customer confirmation email:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            // Send notification email to admin
            try {
                $adminEmail = env('ADMIN_EMAIL', 'minaga0099@gmail.com');
                Log::info('Attempting to send admin notification email to:', ['email' => $adminEmail]);
                Mail::to($adminEmail)->send(new AdminOrderNotification($order));
                Log::info('Admin notification email SENT successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send admin notification email:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

        } else {
            Log::warning('Payment failed or pending', ['status' => $order->status]);
        }
    }

    private function reduceStock($order)
    {
        Log::info('=== STOCK REDUCTION START ===');

        try {
            // Decode the items from JSON
            $items = json_decode($order->items, true);

            if (!$items) {
                Log::error('Failed to decode items JSON', ['items_raw' => $order->items]);
                return;
            }

            Log::info('Items decoded successfully', ['item_count' => count($items), 'items' => $items]);

            // Use database transaction
            DB::beginTransaction();
            Log::info('Database transaction started');

            foreach ($items as $index => $item) {
                Log::info("Processing item #{$index}", [
                    'item_id' => $item['id'] ?? 'MISSING',
                    'quantity' => $item['quantity'] ?? 'MISSING',
                    'title' => $item['title'] ?? 'MISSING'
                ]);

                if (!isset($item['id'])) {
                    Log::warning("Item missing ID, skipping");
                    continue;
                }

                $product = Product::find($item['id']);

                if (!$product) {
                    Log::warning("Product not found in database", ['product_id' => $item['id']]);
                    continue;
                }

                Log::info('Product found in database', [
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'current_stock' => $product->stock,
                    'stock_type' => gettype($product->stock)
                ]);

                $quantity = (int)($item['quantity'] ?? 0);
                $currentStock = is_numeric($product->stock) ? (int)$product->stock : 0;
                $newStock = max(0, $currentStock - $quantity); // Ensure non-negative

                Log::info('Stock calculation', [
                    'current' => $currentStock,
                    'selling' => $quantity,
                    'new' => $newStock
                ]);

                // Update the product stock
                $product->stock = $newStock;
                $saveResult = $product->save();

                Log::info('Product stock update result', [
                    'saved' => $saveResult,
                    'product_id' => $product->id,
                    'new_stock' => $product->stock
                ]);

                // Verify the update
                $verifyProduct = Product::find($product->id);
                Log::info('Verification after save', [
                    'product_id' => $verifyProduct->id,
                    'stock' => $verifyProduct->stock
                ]);
            }

            DB::commit();
            Log::info('Database transaction committed successfully');
            Log::info('=== STOCK REDUCTION COMPLETE ===');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('=== STOCK REDUCTION FAILED ===', [
                'order_id' => $order->order_id,
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }

    public function paymentReturn(Request $request)
    {
        $orderId = $request->query('order_id');

        Log::info('Payment return page accessed', ['order_id' => $orderId]);

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Invalid order');
        }

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            Log::error('Order not found on return page', ['order_id' => $orderId]);
            return redirect()->route('home')->with('error', 'Order not found');
        }

        Log::info('Order status on return page', [
            'order_id' => $orderId,
            'status' => $order->status,
            'payment_id' => $order->payment_id
        ]);

        if ($order->status == 2) {
            // Payment successful - email should have been sent in notify webhook
            Log::info('Showing success page for order', ['order_id' => $orderId]);

            return view('ConfirmationPage', [
                'order' => $order
            ]);
        } else if ($order->status == 0) {
            Log::info('Order still pending', ['order_id' => $orderId]);

            return view('ConfirmationPage', [
                'order' => $order,
                'pending' => true
            ]);
        } else {
            Log::warning('Payment failed or cancelled', ['order_id' => $orderId, 'status' => $order->status]);

            return redirect()->route('home')->with('error', 'Payment was not successful');
        }
    }

    public function trackOrder(Request $request)
    {
        $orderId = $request->query('order_id');

        if (!$orderId) {
            return redirect()->route('home')->with('error', 'Invalid order ID');
        }

        $order = Order::where('order_id', $orderId)->first();

        if (!$order) {
            return redirect()->route('home')->with('error', 'Order not found');
        }

        return view('TrackingPage', [
            'order' => $order
        ]);
    }
}
