<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->title }} - Product Details</title>
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
                        <h2>{{ $product->title }}</h2>
                        <div class="breadcrumb__option">
                            <a href="/">Home</a>
                            <a href="./index.html">{{ $product->category }}</a>
                            <span>{{ $product->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="/product/{{ $product->image }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{ $product->title }}</h3>
                        <div class="product__details__rating">
                            <!-- Rating stars here -->
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">₹{{ $product->discount_price }}
                        
                            <p><del>₹{{ $product->price }}</del></p>
                        
                        </div>

                        

                        <p>{{ $product->description }}</p>

                        <form action="{{ route('add_wishlist', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-lg">
                                <span class="icon_heart_alt"></span><b> ADD TO FAVORITES</b>
                            </button>
                        </form>
                        <br>

                        @if ($product->select == 0 && $product->quantity > 0)
                            <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                @csrf
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="primary-btn btn">ADD TO CART</button>
                            </form>
                        @endif
                        <ul>
                            @if ($product->select == 0 && $product->quantity > 0)
                                <li><b>Availability</b> <span class="text-success"><b>In Stock</b></span></li>
                            @else
                                <li><b>Availability</b> <span class="text-danger"><b>Out of Stock</b></span></li>
                            @endif
                            <li><b>Shipping</b> <span>Upto 12 Hours <span class="text-success"><b> - Free Delivery </b> </span></span></li>
                            <li><b>Weight/Piece</b> <span>{{ $product->weight }}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link{{ empty($product->long_description) && !empty($product->information) ? ' active' : '' }}"
                                    data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="{{ empty($product->long_description) && !empty($product->information) ? 'true' : 'false' }}">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link{{ !empty($product->long_description) && empty($product->information) ? ' active' : '' }}"
                                    data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="{{ !empty($product->long_description) && empty($product->information) ? 'true' : 'false' }}">Information</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            @if (!empty($product->long_description))
                                <div class="tab-pane{{ empty($product->long_description) && !empty($product->information) ? ' active' : '' }}"
                                    id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Description</h6>
                                        <p>{{ $product->long_description }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="tab-pane{{ !empty($product->long_description) && empty($product->information) ? ' active' : '' }}"
                                    id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Description</h6>
                                        <p>Product description not added</p>
                                    </div>
                                </div>
                            @endif

                            @if (!empty($product->information))
                                <div class="tab-pane{{ empty($product->long_description) && !empty($product->information) ? ' active' : '' }}"
                                    id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Information</h6>
                                        <p>{{ $product->information }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="tab-pane{{ !empty($product->long_description) && empty($product->information) ? ' active' : '' }}"
                                    id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Information</h6>
                                        <p>Product information not added</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    @if ($relatedProduct->select == 0 && $relatedProduct->quantity > 0)
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                    data-setbg="product/{{ $relatedProduct->image }}">
                                    <form action="{{ url('add_cart', $relatedProduct->id) }}" method="POST">
                                        @csrf
                                        <ul class="featured__item__pic__hover">
                                            <li>
                                                <form action="{{ url('add_cart', $relatedProduct->id) }}" method="POST">
                                                    @csrf
                                                    <!-- Hidden input field for quantity -->
                                                    <input type="hidden" name="quantity" value="1">
                                                    <!-- Add to Cart button -->
                                                    <button type="submit" class="fa-button" id="cartButton">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a href="/product_details/{{ $relatedProduct->id }}">
                                                    <i class="fa fa-align-justify"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <!-- Form for adding to favorites -->
                                                <form action="{{ route('add_wishlist', $relatedProduct->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="fa-button" id="favoriteButton">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                                <div class="product__discount__item__text">
                                    <span>{{ $relatedProduct->category }}</span>
                                    <h5><a
                                            href="/product_details/{{ $relatedProduct->id }}">{{ $relatedProduct->title }}</a>
                                    </h5>
                                    <div class="product__item__price">₹{{ $relatedProduct->discount_price }}
                                        <span>₹{{ $relatedProduct->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Replace this product -->
                        <!-- You can add whatever content you want for products with select=1 -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg"
                                    data-setbg="product/{{ $relatedProduct->image }}">
                                    
                                        
                                        <ul class="featured__item__pic__hover">
                                            <li>
                                                <p class="text-danger"><b>Out of Stock</b></p>
                                            </li>
                                            <li>
                                                <a href="/product_details/{{ $relatedProduct->id }}">
                                                    <i class="fa fa-align-justify"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <!-- Form for adding to favorites -->
                                                <form action="{{ route('add_wishlist', $relatedProduct->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="fa-button" id="favoriteButton">
                                                        <i class="fa fa-heart"></i>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    
                                </div>
                                <div class="product__discount__item__text">
                                    <span>{{ $relatedProduct->category }}</span>
                                    <h5><a
                                            href="/product_details/{{ $relatedProduct->id }}">{{ $relatedProduct->title }}</a>
                                    </h5>
                                    <div class="product__item__price">₹{{ $product->discount_price }}
                                        <span>₹{{ $product->price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    @include('home.footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('home.js')

</body>

</html>
