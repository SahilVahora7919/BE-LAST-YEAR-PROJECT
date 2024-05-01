<section class="categories" style="display: block !important;">
    <div class="container">
        
        <div class="row"> 
            
            <div class="categories__slider owl-carousel">
                @foreach($categories as $category)
                <div class="col-lg-3">
                    <div class="categories__item set-bg" data-setbg="{{ asset('categories/' . $category->image) }}">
                        <h5><a href="{{url('product_search')}}?query={{ urlencode($category->Category_name) }}">{{ $category->Category_name }}</a></h5>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
        
    </div>
</section>
