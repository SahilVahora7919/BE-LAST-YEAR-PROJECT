<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Css Styles -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Checkout Section Begin -->
    <section class="checkout spad">

        <div class="container">

            <center>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
            </center>

            <center>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                        {{ session()->get('error') }}
                    </div>
                @endif
            </center>

            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form id="cashOnDeliveryForm" action="{{ route('checkout.store') }}" method="POST">

                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input name="first_name" value="SAHIL" class="first_name" type="text"
                                            required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input name="last_name" class="last_name" value="VAHORA" type="text"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input name="country" class="country" type="text" value="INDIA" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" class="address" value="Nadiad" name="address" required>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input name="city" class="city" type="text" value="Nadiad" required>
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input name="state" class="state" type="text" value="Guj" required>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input name="postcode" class="postcode" type="text" value="387001" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input name="phone_number" class="phone_number" type="number"
                                            value="1234567890" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" class="email" type="email" value="sahil@gmail.com"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>

                                <div class="checkout__order__products">Products <span>Total</span></div>

                                <?php
                                $totalPrice = 0;
                                $taxRate = 13;
                                $tax = 0;
                                ?>

                                @foreach ($cart as $cartItem)
                                    <ul>
                                        <li>{{ $cartItem->product_title }} x
                                            {{ $cartItem->quantity }}<span>₹{{ number_format($cartItem->total_price, 2) }}</span>
                                        </li>
                                    </ul>
                                    <?php $totalPrice += $cartItem->total_price; ?>
                                @endforeach

                                <?php $tax = ($totalPrice * $taxRate) / 100; ?>

                                <div class="checkout__order__subtotal">Subtotal
                                    <span>₹{{ number_format($totalPrice, 2) }}</span>
                                    <div class="checkout__order__products">Tax
                                        (GST)<span>₹{{ number_format($tax, 2) }}</span></div>
                                </div>
                                <div class="checkout__order__total">Total
                                    <span>₹{{ number_format($totalPrice + $tax, 2) }}</span>
                                </div>

                                <button type="submit" class="primary-btn btn">CASH ON
                                    DELIVERY</button>

                                <button type="button" class="primary-btn btn razorpay_btn">PAY
                                    Razorpay </button>

                            </div>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->

    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.getElementById('cashOnDeliveryForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission behavior

            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to proceed with Cash On Delivery?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, proceed with form submission
                    this.submit();
                }
            });
        });
    </script>

    @include('home.js')



</body>

</html>
