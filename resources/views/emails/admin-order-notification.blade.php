<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Notification</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #f42525 0%, #d41f1f 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .alert-badge {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 8px 16px;
            border-radius: 20px;
            margin-top: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .order-summary {
            background: #f8f9fa;
            border-left: 4px solid #f42525;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .order-summary h2 {
            margin: 0 0 15px 0;
            font-size: 18px;
            color: #f42525;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 140px 1fr;
            gap: 12px;
            margin-bottom: 15px;
        }
        .info-label {
            font-weight: 600;
            color: #666;
        }
        .info-value {
            color: #333;
        }
        .items-section {
            margin: 25px 0;
        }
        .items-section h3 {
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }
        .item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            margin-right: 15px;
            background: #e9ecef;
        }
        .item-details {
            flex: 1;
        }
        .item-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        .item-meta {
            font-size: 14px;
            color: #666;
        }
        .item-total {
            font-weight: 600;
            color: #f42525;
        }
        .total-section {
            background: #f42525;
            color: white;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
            text-align: right;
        }
        .total-section .label {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .total-section .amount {
            font-size: 32px;
            font-weight: 700;
        }
        .action-button {
            display: inline-block;
            background: #f42525;
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin: 20px 0;
            transition: background 0.3s;
        }
        .action-button:hover {
            background: #d41f1f;
        }
        .customer-section {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .customer-section h3 {
            margin: 0 0 15px 0;
            color: #2196f3;
            font-size: 16px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #4caf50;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        @media only screen and (max-width: 600px) {
            .container {
                margin: 0;
                border-radius: 0;
            }
            .content {
                padding: 20px;
            }
            .info-grid {
                grid-template-columns: 1fr;
                gap: 8px;
            }
            .info-label {
                font-weight: 700;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header -->
    <div class="header">
        <h1>🔔 New Order Received!</h1>
        <div class="alert-badge">Action Required</div>
    </div>

    <!-- Content -->
    <div class="content">
        <p style="font-size: 16px; margin-bottom: 20px;">
            Hello Admin,
        </p>
        <p style="font-size: 16px; margin-bottom: 20px;">
            A new order has been placed on Key Lanka. Please review the details below and process it in the dashboard.
        </p>

        <!-- Order Summary -->
        <div class="order-summary">
            <h2>📦 Order Details</h2>
            <div class="info-grid">
                <div class="info-label">Order ID:</div>
                <div class="info-value"><strong>{{ $order->order_id }}</strong></div>

                <div class="info-label">Payment ID:</div>
                <div class="info-value">{{ $order->payment_id }}</div>

                <div class="info-label">Status:</div>
                <div class="info-value"><span class="status-badge">Paid</span></div>

                <div class="info-label">Order Date:</div>
                <div class="info-value">{{ $order->created_at->format('F d, Y h:i A') }}</div>

                <div class="info-label">Payment Method:</div>
                <div class="info-value">{{ $order->card_holder_name ? 'Card Payment' : 'Online Payment' }}</div>
            </div>

            @if($order->card_holder_name)
                <div class="info-grid" style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                    <div class="info-label">Card Holder:</div>
                    <div class="info-value">{{ $order->card_holder_name }}</div>

                    <div class="info-label">Card Number:</div>
                    <div class="info-value">{{ $order->card_no }}</div>
                </div>
            @endif
        </div>

        <!-- Customer Information -->
        <div class="customer-section">
            <h3>👤 Customer Information</h3>
            <div class="info-grid">
                <div class="info-label">Name:</div>
                <div class="info-value">{{ $order->First_Name }} {{ $order->Last_Name }}</div>

                <div class="info-label">Email:</div>
                <div class="info-value">{{ $order->Email }}</div>

                <div class="info-label">Phone:</div>
                <div class="info-value">{{ $order->Phone }}</div>

                <div class="info-label">Address:</div>
                <div class="info-value">
                    {{ $order->Address }}<br>
                    {{ $order->City }}, {{ $order->State }}<br>
                    {{ $order->Zip_Code }}
                </div>

                @if($order->Delivery_Instructions)
                    <div class="info-label">Delivery Notes:</div>
                    <div class="info-value">{{ $order->Delivery_Instructions }}</div>
                @endif
            </div>
        </div>

        <!-- Order Items -->
        <div class="items-section">
            <h3>🛒 Ordered Items ({{ count($items) }})</h3>
            @foreach($items as $item)
                <div class="item">
                    <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}" class="item-image">
                    <div class="item-details">
                        <div class="item-title">{{ $item['title'] }}</div>
                        <div class="item-meta">
                            Quantity: {{ $item['quantity'] }} × LKR {{ number_format($item['price'], 2) }}
                        </div>
                    </div>
                    <div class="item-total">
                        LKR {{ number_format($item['price'] * $item['quantity'], 2) }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total -->
        <div class="total-section">
            <div class="label">Total Amount Paid</div>
            <div class="amount">LKR {{ number_format($order->paid_amount ?? $order->amount, 2) }}</div>
        </div>

        <!-- Action Button -->
        <div style="text-align: center;">
            <a href="{{ url('/ManageOrders') }}" class="action-button">
                View in Dashboard →
            </a>
        </div>

        <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #dee2e6; color: #666; font-size: 14px;">
            <strong>⚡ Quick Actions:</strong><br>
            Log into your admin dashboard to update the order status, print shipping labels, or contact the customer.
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p style="margin: 0;">
            This is an automated notification from Key Lanka Admin System<br>
            © {{ date('Y') }} Key Lanka. All rights reserved.
        </p>
    </div>
</div>
</body>
</html>
