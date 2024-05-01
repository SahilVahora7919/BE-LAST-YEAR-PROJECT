<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__left">
                        <ul>
                            <li><i class="fa fa-envelope"></i> sahilvhora073@gmail.com</li>
                            <li>Fresh groceries delivered right to you.</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="header__top__right">
                        <div class="header__top__right__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                        <div class="header__top__right__language">
                            <img src="img/language.png" alt="">
                            <div>English</div>
                            {{-- <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="#">Spanis</a></li>
                                <li><a href="#">English</a></li>
                            </ul> --}}
                        </div>
                        <!-- Example split danger button -->

                        <div class="header__top__right__language">
                            @if (Route::has('login'))
                                @auth
                                    <div><span class="nav-label">{{ Auth::user()->name }} <span class="caret"></span></div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="{{ url('/show_order') }}">My Order</a></li>
                                        <li><a href="{{ url('/user/profile') }}">Profile</a></li>
                                        @if (auth()->user()->usertype == 1)
                                            <li><a href="{{ url('/redirect') }}">Admin Panel</a></li>
                                        @endif

                                        <li><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                        <form id="logout-form" method="POST" action="{{ route('logout') }}"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </ul>
                                @else
                                    <div class="header__top__right__auth">
                                        <a href="{{ route('login') }}"><i class="fa fa-user"></i>My Account</a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="/"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="{{ Request::is('/') ? 'active' : '' }}">
                            <a href="/">Home</a>
                        </li>
                        
                        <li class="{{ Request::is('shop') ? 'active' : '' }}">
                            <a href="{{ url('/shop') }}">Shop</a>
                        </li>

                        <li class="{{ Request::is('contact') ? 'active' : '' }}">
                            <a href="{{ url('/contact') }}">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                        <li>
                            <a href="{{ route('show_wishlist') }}">
                                <i class="fa fa-heart"></i>
                                @if ($favoriteCount > 0)
                                    <span>{{ $favoriteCount }}</span>
                                @else
                                    <span>0</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                    
                    <ul>
                        <li>
                            @if ($cartCount > 0)
                                <a href="{{ url('show_cart') }}"><i class="fa fa-shopping-bag"></i>
                                    <span>{{ $cartCount }}</span></a>
                            @else
                                <a href="{{ url('show_cart') }}"><i class="fa fa-shopping-bag"></i> <span>0</span></a>
                            @endif
                        </li>
                    </ul>


                    <?php
                    $totalprice = 0;
                    $tax = 0;
                    ?>

                    @if (isset($cart) && count($cart) > 0)
                        @foreach ($cart as $cartItem)
                            <?php
                            $totalprice += (float) $cartItem->total_price;
                            $tax = ($totalprice * 13) / 100;
                            ?>
                        @endforeach
                    @endif

                    <?php
                    $grandTotal = $totalprice + $tax;
                    $formattedTotal = number_format($grandTotal, 2); // Format total to 2 decimal places
                    ?>

                    <div class="header__cart__price">Item: <span>₹{{ $formattedTotal }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
