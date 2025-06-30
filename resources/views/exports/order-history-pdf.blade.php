<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order History Export</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3B82F6;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #1F2937;
            font-size: 24px;
            margin: 0;
        }

        .header p {
            color: #6B7280;
            margin: 5px 0;
        }

        .order-card {
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            margin-bottom: 20px;
            overflow: hidden;
            page-break-inside: avoid;
        }

        .order-header {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            padding: 15px;
            border-bottom: 1px solid #E5E7EB;
        }

        .order-header h3 {
            margin: 0 0 5px 0;
            color: #1F2937;
            font-size: 16px;
        }

        .order-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .order-date {
            color: #6B7280;
            font-size: 11px;
        }

        .order-total {
            font-size: 18px;
            font-weight: bold;
            color: #059669;
        }

        .order-items {
            padding: 0;
        }

        .order-item {
            padding: 12px 15px;
            border-bottom: 1px solid #F3F4F6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #1F2937;
            margin-bottom: 2px;
        }

        .item-quantity {
            color: #6B7280;
            font-size: 11px;
        }

        .item-price {
            font-weight: 600;
            color: #059669;
            text-align: right;
        }

        .summary {
            margin-top: 30px;
            padding: 20px;
            background: #F9FAFB;
            border-radius: 8px;
            border: 1px solid #E5E7EB;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
            font-weight: bold;
            font-size: 14px;
            color: #1F2937;
            border-top: 1px solid #E5E7EB;
            padding-top: 8px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #9CA3AF;
            font-size: 10px;
            border-top: 1px solid #E5E7EB;
            padding-top: 20px;
        }

        @media print {
            body { margin: 0; }
            .order-card { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Order History Export</h1>
    <p><strong>Customer:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Export Date:</strong> {{ $exportDate }}</p>
    <p><strong>Total Orders:</strong> {{ $orders->count() }}</p>
</div>

@foreach($orders as $order)
    <div class="order-card">
        <div class="order-header">
            <h3>Order #{{ $order->id }}</h3>
            <div class="order-meta">
                <span class="order-date">{{ $order->created_at->format('F d, Y \a\t g:i A') }}</span>
                <span class="order-total">${{ number_format($order->total_price, 2) }}</span>
            </div>
        </div>

        <div class="order-items">
            @foreach($order->orderlines as $orderline)
                <div class="order-item">
                    <div class="item-details">
                        <div class="item-name">{{ $orderline->product_name }}</div>
                        <div class="item-quantity">Quantity: {{ $orderline->quantity }}</div>
                    </div>
                    <div class="item-price">${{ number_format($orderline->line_total, 2) }}</div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<div class="summary">
    <div class="summary-row">
        <span>Total Orders:</span>
        <span>{{ $orders->count() }}</span>
    </div>
    <div class="summary-row">
        <span>Total Items:</span>
        <span>{{ $orders->sum(function($order) { return $order->orderlines->sum('quantity'); }) }}</span>
    </div>
    <div class="summary-row">
        <span>Grand Total:</span>
        <span>${{ number_format($orders->sum('total_price'), 2) }}</span>
    </div>
</div>

<div class="footer">
    <p>This document was generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
    <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
</div>
</body>
</html>
