<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
        }

        .invoice-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .invoice-title {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        .invoice-heading {
            margin-bottom: 10px;
        }

        .table th,
        .table td {
            border-top: none !important;
        }

        .total {
            margin-top: 20px;
        }

        .total h3 {
            color: #28a745;
        }

        .inr-sign::before {
            content: "\20B9";
        }

        // Or use with ::after
        .inr-sign::after {
            content: "\20B9";
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="invoice-container">
                    <h2 class="invoice-title">Invoice</h2>
                    <div class="row invoice-heading">
                        <div class="col">
                            <p>Invoice Number: #{{ $order->id }}</p>
                            <p>Purchase Date and Time: {{ $order->created_at }}</p>
                        </div>
                    </div>
                    <div class="row invoice-heading">
                        <div class="col">
                            <h4>Customer Information:</h4>
                            <p>Customer Name: {{ $order->first_name }} {{ $order->last_name }}</p>
                            <p>Email: {{ $order->email }}</p>
                            <p>Contact Number: {{ $order->phone_number }}</p>
                            <p>Address: {{ $order->address }}, {{ $order->city }} - {{ $order->postcode }},
                                {{ $order->state }}, {{ $order->country }}</p>
                        </div>
                    </div>
                    <div class="row invoice-heading">
                        <div class="col">
                            <h4>Payment Information:</h4>
                            <?php if ($order->razorpay_payment_id !== null): ?>
                                <p>Payment Type: Online</p>
                                <p>Payment ID: <?php echo $order->razorpay_payment_id; ?></p>
                            <?php else: ?>
                                <p>Payment Type: Cash on Delivery</p>
                            <?php endif; ?>
                        </div>
                    </div>                    
                    <div class="row mt-3">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr class="col text-center">
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="col text-center">
                                        <td>{{ $order->product_title }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>{{ $order->discount_price }}</td>
                                        <td>{{ $order->itemTotalPrice }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row total">
                        <div class="col text-center">
                            <p>Subtotal: {{ $order->itemTotalPrice }}</p>
                            <p>Tax (13%): {{ $order->tax }}</p>
                            <h3>Total:{{ $order->total_price }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
