<section class="hero hero-normal">
    <div class="container">
        <div class="row">

            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All departments</span>
                    </div>
                    <ul>
                        @php
                            $randomCategories = $categories->count() >= 10 ? $categories->random(10) : $categories;
                        @endphp
                        @foreach ($randomCategories as $category)
                            <li><a
                                    href="{{ url('product_search') }}?query={{ urlencode($category->Category_name) }}">{{ $category->Category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>


            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="{{ url('product_search') }}" method="GET">

                            <div class="hero__search__categories text-center">
                                Product Name : 👉
                            </div>

                            @csrf

                            <input type="text" name="query" placeholder="What do you need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+91 932-856-3068</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
