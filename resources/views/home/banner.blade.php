<div class="banner">
    <div class="container">
        <div class="row">
            @php
                // Shuffle the banners array
                $shuffledBanners = $banners->shuffle()->take(4);
            @endphp

            @foreach($shuffledBanners as $banner)
            <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                <div class="banner__pic">
                    <a href="{{url('product_search')}}?query={{ urlencode($banner->banner_name) }}">
                        <img src="{{ asset('img/banner/' . $banner->image) }}" alt="/">
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
