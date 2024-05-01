<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Latest Product</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach ($products as $product)
                @if ($product->select == 0 && $product->quantity > 0)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="product/{{ $product->image }}">
                                <ul class="featured__item__pic__hover">
                                    <li>
                                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
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
                                        <a href="/product_details/{{ $product->id }}">
                                            <i class="fa fa-align-justify"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <!-- Form for adding to favorites -->
                                        <form action="{{ route('add_wishlist', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="fa-button" id="favoriteButton">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <span>{{ $product->category }}</span>
                                <h5><a href="/product_details/{{ $product->id }}">{{ $product->title }}</a></h5>
                                <div class="product__item__price">₹{{ $product->discount_price }}
                                    <span>₹{{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Replace this product -->
                    <!-- You can add whatever content you want for products with select=1 -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="product/{{ $product->image }}">
                                
                                    <ul class="featured__item__pic__hover">
                                        <li>
                                            <p class="text-danger"><b>Out of Stock</b></p>
                                        </li>
                                        <li>
                                            <a href="/product_details/{{ $product->id }}">
                                                <i class="fa fa-align-justify"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <!-- Form for adding to favorites -->
                                            <form action="{{ route('add_wishlist', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="fa-button" id="favoriteButton">
                                                    <i class="fa fa-heart"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                               
                            </div>
                            <div class="product__discount__item__text">
                                <span>{{ $product->category }}</span>
                                <h5><a href="/product_details/{{ $product->id }}">{{ $product->title }}</a></h5>
                                <div class="product__item__price">₹{{ $product->discount_price }}
                                    <span>₹{{ $product->price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        @php
            // Extracting the current page from the pagination links
            $currentPage = $products->currentPage();

            // Getting the last page number
            $lastPage = $products->lastPage();
        @endphp

        <div class="container d-flex justify-content-center">

            <div class="product__pagination">
                @if ($currentPage > 1)
                    <a href="{{ $products->url($currentPage - 1) }}"><i class="fa fa-long-arrow-left"></i></a>
                @endif

                @for ($i = 1; $i <= $lastPage; $i++)
                    <a href="{{ $products->url($i) }}"
                        @if ($i == $currentPage) class="active" @endif>{{ $i }}</a>
                @endfor

                @if ($currentPage < $lastPage)
                    <a href="{{ $products->url($currentPage + 1) }}"><i class="fa fa-long-arrow-right"></i></a>
                @endif
            </div>

        </div>

    </div>
    </div>
</section>
