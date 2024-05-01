<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Css Styles -->
    <base href="/public">
    @include('home.css')
</head>

<body>

    <!-- Humberger Begin -->
    @include('home.humberger')
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    @include('home.header')
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    @include('home.hero')
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>My Order</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>My Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="text-center"></th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total Price</th>
                                    <th class="text-center">Payment</th>
                                    <th class="text-center">Delivery</th>
                                    <th class="text-center">Cancel Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $order)
                                    <tr>
                                        <td>
                                            <img style="height: 100px; width:100px;" src="/product/{{ $order->image }}"
                                                alt="">

                                        </td>
                                        <td class="shoping__cart__price text-center">
                                            <h5>{{ $order->product_title }}</h5>
                                        </td>
                                        <td class="shoping__cart__price text-center">
                                            {{ $order->quantity }}
                                        </td>
                                        <td class="shoping__cart__total text-center">
                                            ₹{{ $order->total_price }}
                                        </td>
                                        <td class="shoping__cart__price text-center">
                                            {{ $order->payment_status }}
                                        </td>
                                        <td class="shoping__cart__price text-center">
                                            {{ $order->delivery_status }}
                                        </td>
                                        <td class="shoping__cart__remove">
                                            @if ($order->delivery_status == 'Processing')
                                                <a onclick="showCancelOrderConfirmation('{{ url('/cancel_order', $order->id) }}');"
                                                    class="danger-btn btn">CANCEL ORDER</a>
                                            @elseif ($order->delivery_status == 'Order Cancelled')
                                                <a class="danger-btn btn disabled">
                                                    CANCELLED</a>
                                            @else
                                                <a class="primary-btn btn disabled">
                                                    DELIVERED</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function showCancelOrderConfirmation(cancelUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to cancel this order?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, cancel it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to cancel URL
                    window.location.href = cancelUrl;
                }
            });
        }
    </script>
    <!-- Js Plugins -->
    @include('home.js')

</body>

</html>
