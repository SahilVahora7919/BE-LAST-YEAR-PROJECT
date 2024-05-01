<section class="latest-product spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">



                <div class="latest-product__text">
                    <h4>Latest Products</h4>

                    <div class="latest-product__slider owl-carousel">
                        @php $totalProducts = count($products); @endphp
                        @for ($i = 0; $i < $totalProducts; $i += 3)
                            <div class="latest-prdouct__slider__item">
                                @for ($j = $i; $j < $i + 3 && $j < $totalProducts; $j++)
                                    @php $product = $products[$j]; @endphp
                                    <a href="{{ url('product_details', $product->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="product/{{ $product->image }}" alt="">
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{ $product->category }}</span>
                                            <h6>{{ $product->title }}</h6>
                                            <div class="product__item__price">₹{{ $product->discount_price }}
                                                <span>₹{{ $product->price }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                            </div>
                        @endfor
                    </div>


                </div>
            </div>



            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Top Rated Products</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                            $shuffledProducts = $products->shuffle(); // Shuffle the products
                            $totalProducts = count($shuffledProducts);
                        @endphp
                        @for ($i = 0; $i < $totalProducts; $i += 3)
                            <div class="latest-prdouct__slider__item">
                                @for ($j = $i; $j < $i + 3 && $j < $totalProducts; $j++)
                                    @php $product = $shuffledProducts[$j]; @endphp
                                    <a href="{{ url('product_details', $product->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="product/{{ $product->image }}" alt="">
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{ $product->category }}</span>
                                            <h6>{{ $product->title }}</h6>
                                            <div class="product__item__price">₹{{ $product->discount_price }}
                                                <span>₹{{ $product->price }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Today Favourite</h4>
                    <div class="latest-product__slider owl-carousel">
                        @php
                            $shuffledProducts = $products->shuffle(); // Shuffle the products
                            $totalProducts = count($shuffledProducts);
                        @endphp
                        @for ($i = 0; $i < $totalProducts; $i += 3)
                            <div class="latest-prdouct__slider__item">
                                @for ($j = $i; $j < $i + 3 && $j < $totalProducts; $j++)
                                    @php $product = $shuffledProducts[$j]; @endphp
                                    <a href="{{ url('product_details', $product->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="product/{{ $product->image }}" alt="">
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{ $product->category }}</span>
                                            <h6>{{ $product->title }}</h6>
                                            <div class="product__item__price">₹{{ $product->discount_price }}
                                                <span>₹{{ $product->price }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
