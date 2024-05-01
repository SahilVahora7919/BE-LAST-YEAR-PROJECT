<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        <h2>Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <span>Wishlist</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="featured spad">
        <div class="container">
            <div class="col-lg-12">
                <div class="product__discount">
                    <div class="row">
                        @foreach ($favorites->chunk(4) as $chunk)
                            <div class="col-lg-12">
                                <div class="row">
                                    @foreach ($chunk as $product)
                                        @if ($product->select == 0)
                                            <div class="col-lg-3">
                                                <div class="product__discount__item">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="product/{{ $product->image }}">
                                                        <ul class="product__item__pic__hover">
                                                            <li>
                                                                <form action="{{ url('add_cart', $product->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <!-- Hidden input field for quantity -->
                                                                    <input type="hidden" name="quantity"
                                                                        value="1">
                                                                    <!-- Add to Cart button -->
                                                                    <button type="submit" class="fa-button"
                                                                        id="cartButton">
                                                                        <i class="fa fa-shopping-cart"></i>
                                                                    </button>
                                                                </form>
                                                            </li>
                                                            <li>
                                                                <a href="/product_details/{{ $product->id }}">
                                                                    <i class="fa fa-align-justify"></i>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    onclick="showRemoveFromWishlistConfirmation('{{ route('remove_wishlist', $product->id) }}');">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </li>
                                                            <!-- Close button -->
                                                        </ul>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <span>{{ $product->category }}</span>
                                                        <h5><a
                                                                href="/product_details/{{ $product->id }}">{{ $product->title }}</a>
                                                        </h5>
                                                        <div class="product__item__price">
                                                            ₹{{ $product->discount_price }}
                                                            <span>₹{{ $product->price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-3">
                                                <div class="product__discount__item">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="product/{{ $product->image }}">
                                                        <ul class="product__item__pic__hover">
                                                            <li>
                                                                <p class="text-danger"><b>Out of Stock</b></p>
                                                            </li>
                                                            <li>
                                                                <a
                                                                    onclick="showRemoveFromWishlistConfirmation('{{ route('remove_wishlist', $product->id) }}');">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <span>{{ $product->category }}</span>
                                                        <h5><a
                                                                href="/product_details/{{ $product->id }}">{{ $product->title }}</a>
                                                        </h5>
                                                        <div class="product__item__price">
                                                            ₹{{ $product->discount_price }}
                                                            <span>₹{{ $product->price }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
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
        function showRemoveFromWishlistConfirmation(removeUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to remove this product from your wishlist?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to remove URL
                    window.location.href = removeUrl;
                }
            });
        }
    </script>
    <!-- Js Plugins -->
    @include('home.js')

</body>

</html>
