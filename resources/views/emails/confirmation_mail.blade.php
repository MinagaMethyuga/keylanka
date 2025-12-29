<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation - Key Lanka</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #f42525;
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
        }
        .content {
            padding: 30px 20px;
            background-color: #ffffff;
        }
        .order-details {
            background-color: #f9f9f9;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #f42525;
        }
        .order-details h2 {
            margin-top: 0;
            color: #f42525;
            font-size: 20px;
        }
        .order-details p {
            margin: 8px 0;
        }
        .items-list {
            margin: 20px 0;
        }
        .item {
            display: table;
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
        }
        .item-image {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
        }
        .item-image img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .item-details {
            display: table-cell;
            padding-left: 15px;
            vertical-align: middle;
        }
        .item-name {
            font-weight: bold;
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
        }
        .item-price {
            color: #666;
            font-size: 14px;
        }
        .item-quantity {
            color: #999;
            font-size: 13px;
            margin-top: 3px;
        }
        .track-button {
            display: inline-block;
            background-color: #f42525;
            color: white;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .track-button:hover {
            background-color: #d41f1f;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 25px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #e0e0e0;
        }
        .info-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 18px;
            font-weight: bold;
            color: #f42525;
            border-top: 2px solid #e0e0e0;
            margin-top: 15px;
            padding-top: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>✓ Thank You for Your Order!</h1>
    </div>

    <div class="content">
        <p>Dear <strong>{{ $order->First_Name }} {{ $order->Last_Name }}</strong>,</p>

        <p>Your order has been confirmed and is being processed. We're excited to get your items to you!</p>

        <div class="order-details">
            <h2>📋 Order Information</h2>
            <p><strong>Order Number:</strong> {{ $order->order_id }}</p>
            <p><strong>Payment ID:</strong> {{ $order->payment_id }}</p>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('F d, Y') }}</p>
        </div>

        <div class="divider"></div>

        <h2 style="color: #f42525;">🛒 Order Summary</h2>
        <div class="items-list">
            @php
                $items = json_decode($order->items ?? '[]', true);
                if (!is_array($items)) {
                    $items = [];
                }
            @endphp

            @forelse($items as $item)
                <div class="item">
                    <div class="item-details">
                        <div class="item-name">{{ $item['title'] ?? 'Product' }}</div>
                        <div class="item-price">{{ $order->currency }} {{ number_format($item['price'] ?? 0, 2) }}</div>
                        <div class="item-quantity">Quantity: {{ $item['quantity'] ?? 1 }}</div>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #999;">No items found</p>
            @endforelse
        </div>

        <div class="total-row">
            <span>Total Amount:</span>
            <span>{{ $order->currency }} {{ number_format($order->paid_amount ?? $order->amount, 2) }}</span>
        </div>

        <div class="divider"></div>

        <div class="order-details">
            <h3 style="margin-top: 0; color: #333;">📍 Shipping Address</h3>
            <p>
                {{ $order->Address }}<br>
                {{ $order->City }}, {{ $order->State }} {{ $order->Zip_Code }}<br>
                <strong>Phone:</strong> {{ $order->Phone }}
            </p>

            @if($order->Delivery_Instructions)
                <div class="info-box">
                    <strong>📝 Delivery Instructions:</strong><br>
                    {{ $order->Delivery_Instructions }}
                </div>
            @endif
        </div>

        <div class="button-container">
            <a href="{{ url('/track-order?order_id=' . $order->order_id) }}" class="track-button">
                📦 Track Your Order
            </a>
        </div>

        <div class="divider"></div>

        <p style="text-align: center; color: #666;">
            We will send you another email with tracking information once your order ships.
        </p>

        <p style="text-align: center; color: #666;">
            If you have any questions, please contact us at <a href="mailto:support@keylanka.com" style="color: #f42525;">support@keylanka.com</a>
        </p>
    </div>

    <div class="footer">
        <p style="margin: 5px 0;"><strong>Key Lanka</strong></p>
        <p style="margin: 5px 0;">Your trusted partner for quality keys and security solutions</p>
        <p style="margin: 15px 0 5px 0;">&copy; {{ date('Y') }} Key Lanka. All rights reserved.</p>
    </div>
</div>
</body>
</html>
