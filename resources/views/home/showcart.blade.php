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

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalprice = 0;
                                $tax = 0;
                                ?>
                                @foreach ($cart as $cart)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img style="height: 100px; width:101px;" src="/product/{{ $cart->image }}"
                                                alt="">
                                            <h5>{{ $cart->product_title }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ₹{{ $cart->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">

                                                <!-- Inside the <td class="shoping__cart__quantity"> in the table -->
                                                <div class="container">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-7">
                                                            <form
                                                                action="{{ route('cart.update', ['id' => $cart->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <button class="btn btn-secondary opacity-25"
                                                                            type="submit" name="decrease">-</button>
                                                                    </div>
                                                                    <input type="number"
                                                                        class="form-control text-center" name="quantity"
                                                                        value="{{ $cart->quantity }}">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-secondary opacity-25"
                                                                            type="submit" name="increase">+</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ₹{{ $cart->total_price }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ url('/remove_cart', $cart->id) }}">
                                                <span class="icon_close"></span></a>
                                        </td>
                                    </tr>
                                    <?php
                                    $totalprice += (float) $cart->total_price;
                                    ?>
                                @endforeach
                                <?php
                                $tax = ($totalprice * 13) / 100;
                                $grandTotal = $totalprice + $tax;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="/" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="primary-btn btn site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span id="subtotal">₹{{ number_format($totalprice, 2) }}</span></li>
                            <li>Tax (GST) <span id="tax">₹{{ number_format($tax, 2) }}</span></li>
                            <li>Total <span id="grandtotal">₹{{ number_format($grandTotal, 2) }}</span></li>
                        </ul>
                        <form action="{{ route('home.checkout') }}" method="GET">
                            @csrf
                            <center>
                                <button type="submit" class="primary-btn btn">PROCEED TO CHECKOUT</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('home.js')

    <script>
        function updateCartItem(cartId, quantity) {
            $.ajax({
                url: '/update_cart/' + cartId,
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    quantity: quantity
                },
                success: function(response) {
                    // Update the total price and tax on the page
                    var totalprice = response.totalprice;
                    var tax = response.tax;
                    var grandtotal = totalprice + tax;
                    document.getElementById('subtotal').innerText = '₹' + totalprice.toFixed(2);
                    document.getElementById('tax').innerText = '₹' + tax.toFixed(2);
                    document.getElementById('grandtotal').innerText = '₹' + grandtotal.toFixed(2);
                }
            });
        }
    </script>

</body>

</html>
