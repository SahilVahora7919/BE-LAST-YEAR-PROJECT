<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Favorite;


class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $cart = Cart::all();
        $products = Product::latest()->paginate(12);

        $banners = Banner::all();

        $cartCount = 0;
        $cart = collect(); // Initialize an empty collection

        // Check if there is an authenticated user
        if (auth()->check()) {
            // Retrieve the cart items for the current user
            $user_id = auth()->id();
            $cart = Cart::where('user_id', $user_id)->get();

            // Calculate the count of cart items
            $cartCount = $cart->count();
        }

        // Calculate the total price of items in the cart
        $totalprice = $cart->sum('price');

        // Retrieve the count of favorite items for the current user
        $favoriteCount = 0;
        if (auth()->check()) {
            $favoriteCount = Favorite::where('user_id', auth()->id())->count();
        }

        // Pass the variables to the view
        return view('home.userpage', compact('products', 'cartCount', 'cart', 'totalprice', 'favoriteCount', 'categories', 'banners'));
    }
    public function redirect()
    {
        // Fetch categories from the database
        $categories = Category::all();
        $cart = Cart::all();
        $banners = Banner::all();
        // Count the number of favorite products for the logged-in user
        $favoriteCount = Favorite::where('user_id', auth()->id())->count();
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            // If user type is admin, return admin home view without passing categories

            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $categories = Category::all()->count();

            // Filter orders by delivery status 'Delivered'
            $orders = Order::where('delivery_status', 'Delivered')->get();

            $cancel_orders = Order::where('delivery_status', 'Order Cancelled')->count();

            $total_revenue = 0;
            $total_tax = 0;
            $total_orders = 0;
            $razorpay_orders = 0;
            $razorpay_revenue = 0;
            $revenue_data = []; // Array to hold day-to-day revenue data

            foreach ($orders as $order) {
                $total_revenue += $order->total_price;
                $total_tax += $order->tax;

                // Assuming order date is stored in 'created_at' field
                $order_date = date('Y-m-d', strtotime($order->created_at));

                $total_orders = $orders->count();

                // Count the number of orders with Razorpay payment id
                $razorpay_orders = $orders->whereNotNull('razorpay_payment_id')->count();

                // Calculate the number of non-Razorpay orders
                $nonRazorpayOrders = $total_orders - $razorpay_orders;

                if (!isset($revenue_data[$order_date])) {
                    $revenue_data[$order_date] = 0;
                }

                if ($order->razorpay_payment_id !== null) {
                    $razorpay_revenue += $order->total_price;
                }

                $revenue_data[$order_date] += $order->total_price;
            }

            // Calculate day-to-day revenue
            $daily_revenue = collect($revenue_data)->sortBy('date')->toArray();

            $category_revenue = [];
            foreach ($orders as $order) {
                $category = $order->category;
                $total_price = $order->total_price;

                if (!isset($category_revenue[$category])) {
                    $category_revenue[$category] = 0;
                }

                $category_revenue[$category] += $total_price;
            }

            $total_sales = count($orders);
            $total_processing = Order::where('delivery_status', 'Processing')->count();
            $total_admin = User::where('usertype', '1')->count();

            // Check if a new order has been added recently
            $new_order_added = Order::where('created_at', '>=', now()->subMinutes(60))->exists();

            // Check if a new user has been registered recently
            $new_user_registered = User::where('created_at', '>=', now()->subMinutes(60))->exists();

            return view('admin.home', compact('total_product', 'cancel_orders', 'total_orders', 'razorpay_orders', 'razorpay_revenue', 'total_user', 'total_order', 'total_revenue', 'total_sales', 'total_processing', 'total_tax', 'total_admin', 'daily_revenue', 'category_revenue', 'orders', 'categories', 'new_order_added', 'new_user_registered'));

        } else {
            // If user type is not admin, return userpage view passing categories, products, cartCount, and favoriteCount
            $products = Product::latest()->paginate(12);
            $user_id = auth()->user()->id;
            $cart = Cart::where('user_id', $user_id)->get();
            $cartCount = $cart->count();

            // Pass variables to the view
            return view('home.userpage', compact('products', 'cartCount', 'categories', 'favoriteCount', 'banners'));
        }
    }
    public function product_details($id)
    {
        try {
            // Attempt to find the product by its ID
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            // Product with the given ID was not found
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        // If the user is authenticated, fetch their favorite count and cart
        if (auth()->check()) {
            $favoriteCount = Favorite::where('user_id', auth()->id())->count();
            $user_id = auth()->user()->id;
            $cart = Cart::where('user_id', $user_id)->get();
            $cartCount = $cart->count();
            $categories = Category::all();
        } else {
            // If the user is not authenticated, set default values for favorite count and cart count
            $favoriteCount = 0;
            $cart = collect(); // Empty collection
            $cartCount = 0;
            $categories = Category::all();
        }

        // Fetch related products
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $id)
            ->inRandomOrder()
            ->paginate(4);

        return view('home.product_details', compact('product', 'relatedProducts', 'cart', 'cartCount', 'favoriteCount', 'categories'));
    }

    public function add_cart(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Check if the product already exists in the user's cart
        $existingCart = Cart::where('user_id', $user->id)->where('product_id', $product->id)->first();

        // If the product already exists in the cart, update the quantity
        if ($existingCart) {
            $existingCart->quantity += $request->quantity;
            $existingCart->total_price = $existingCart->price * $existingCart->quantity;
            $existingCart->save();
        } else {
            // If the product does not exist in the cart, create a new cart item
            $cart = new Cart;
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->user_id = $user->id;
            $cart->product_title = $product->title;
            $cart->price = $product->discount_price;
            $cart->total_price = $product->discount_price * $request->quantity;
            $cart->image = $product->image;
            $cart->product_id = $product->id;
            $cart->quantity = $request->quantity;
            $cart->weight = $product->weight;
            $cart->category = $product->category;
            $cart->save();
        }

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function show_cart()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->get();
        $cartCount = $cart->count();
        $categories = Category::all();
        $favoriteCount = Favorite::where('user_id', auth()->id())->count();

        return view('home.showcart', compact('cart', 'cartCount', 'favoriteCount', 'categories'));
    }

    public function remove_cart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return redirect()->back();
    }

    public function checkout()
    {
        $user_id = auth()->user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        $cartCount = $cart->count(); // Calculate the count of cart items
        $favoriteCount = Favorite::where('user_id', auth()->id())->count();
        $categories = Category::all();

        return view('home.checkout', compact('cart', 'cartCount', 'favoriteCount', 'categories'));
    }

    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        if ($request->has('increase')) {
            $cart->quantity += 1;
        } elseif ($request->has('decrease') && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }

        $cart->total_price = $cart->price * $cart->quantity;
        $cart->save();

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        // Retrieve cart items for the user
        $cartItems = Cart::where('user_id', $userId)->get();

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add products before placing an order.');
        }

        // Process each cart item
        foreach ($cartItems as $cartItem) {
            // Proceed to create order
            $order = new Order();
            $order->user_id = $userId;

            // Fill order details from request
            $order->first_name = $request->input('first_name');
            $order->last_name = $request->input('last_name');
            $order->country = $request->input('country');
            $order->address = $request->input('address');
            $order->city = $request->input('city');
            $order->state = $request->input('state');
            $order->postcode = $request->input('postcode');
            $order->phone_number = $request->input('phone_number');
            $order->email = $request->input('email');
            $order->razorpay_payment_id = $request->input('razorpay_payment_id');

            // Fill order details from cart item
            $order->product_title = $cartItem->product_title;
            $order->category = $cartItem->category;
            $order->discount_price = $cartItem->price; // Or whatever you need here
            $order->image = $cartItem->image;
            $order->product_id = $cartItem->product_id;
            $order->quantity = $cartItem->quantity;
            $order->weight = $cartItem->weight;

            // Calculate item total price
            $itemTotalPrice = $cartItem->price * $cartItem->quantity;
            $order->itemTotalPrice = $itemTotalPrice;

            // Set default values for payment and delivery status
            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'Processing';

            // Calculate tax and total price
            $tax = ($itemTotalPrice * 13) / 100;
            $order->tax = $tax;
            $order->total_price = $itemTotalPrice + $tax;

            // Save the order
            $order->save();

            // Update product quantity
            $product = Product::find($cartItem->product_id);
            $product->quantity -= $cartItem->quantity;
            $product->save();

            // Delete the item from cart
            $cartItem->delete();
        }

        // Redirect the user
        return redirect()->back()->with('message', 'Order placed successfully!');
    }

    public function add_wishlist($id)
    {
        $user = Auth::user();

        $product = Product::findOrFail($id);

        // Check if the product is already a favorite
        $existingFavorite = Favorite::where('user_id', $user->id)->where('product_id', $product->id)->first();

        // If the product is not already a favorite, add it to favorites
        if (!$existingFavorite) {
            $favorite = new Favorite;
            $favorite->user_id = $user->id;
            $favorite->product_id = $product->id;
            $favorite->save();
        }

        return redirect()->back();
    }

    public function show_wishlist()
    {
        // Retrieve the authenticated user's favorites
        $favorites = auth()->user()->favorites()->get();

        // Retrieve the cart items for the authenticated user
        $cart = Cart::where('user_id', auth()->id())->get();
        $cartCount = $cart->count();
        $categories = Category::all();

        // Count the number of favorite products
        $favoriteCount = $favorites->count();

        // Pass data to the view
        return view('home.favorite_products', [
            'favorites' => $favorites, // Corrected variable name
            'favoriteCount' => $favoriteCount,
            'cart' => $cart, // Pass the cart items to the view
            'cartCount' => $cartCount,
            'categories' => $categories, // Pass the cart count to the view
        ]);
    }

    public function remove_wishlist($product_id)
    {
        Favorite::where('product_id', $product_id)->delete();

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Favorite removed successfully');
    }

    public function product_search(Request $request)
    {
        // Retrieve the search text from the request
        $query = $request->input('query');

        // Search for products matching the search text
        $products = Product::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('category', 'LIKE', '%' . $query . '%')
            ->latest()
            ->paginate(8);

        // Retrieve all categories
        $categories = Category::all();

        // Retrieve the count of cart items for the current user
        $cartCount = auth()->check() ? Cart::where('user_id', auth()->id())->count() : 0;

        // Retrieve the count of favorite items for the current user
        $favoriteCount = auth()->check() ? auth()->user()->favorites()->count() : 0;

        // Pass the retrieved data to the view
        return view('home.search-results', compact('products', 'categories', 'cartCount', 'favoriteCount'));
    }

    public function show_order()
    {
        // Retrieve the authenticated user's favorites
        $favorites = auth()->user()->favorites()->get();

        // Retrieve the cart items for the authenticated user
        $cart = Cart::where('user_id', auth()->id())->get();
        $cartCount = $cart->count();
        $categories = Category::all();

        // Count the number of favorite products
        $favoriteCount = $favorites->count();

        $user = Auth::user();
        $userid = $user->id;
        $order = Order::where('user_id', '=', $userid)->latest()->get();


        // Pass data to the view
        return view('home.order', [
            'favorites' => $favorites, // Corrected variable name
            'favoriteCount' => $favoriteCount,
            'cart' => $cart, // Pass the cart items to the view
            'cartCount' => $cartCount,
            'categories' => $categories,
            'order' => $order, // Pass the cart count to the view
        ]);
    }

    public function cancel_order($id)
    {

        $order = Order::find($id);


        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }


        $product = Product::find($order->product_id);


        if (!$product) {
            return redirect()->back()->with('error', 'Product associated with the order not found.');
        }

        try {

            DB::beginTransaction();


            $product->increment('quantity', $order->quantity);


            $order->delivery_status = 'Order Cancelled';
            $order->save();


            DB::commit();

            return redirect()->back()->with('message', 'Order canceled successfully!');
        } catch (\Exception $e) {

            DB::rollback();
            return redirect()->back()->with('error', 'Failed to cancel order. Please try again.');
        }
    }

    public function shop()
    {
        $products = Product::latest()->paginate(12);
        $productrand = Product::inRandomOrder()->limit(9)->get();

        // Initialize variables with default values
        $favorites = collect();
        $cart = collect();
        $cartCount = 0;
        $categories = Category::all();
        $favoriteCount = 0;

        // Check if the user is authenticated
        if (auth()->check()) {
            $favorites = auth()->user()->favorites()->get();

            // Retrieve the cart items for the authenticated user
            $cart = Cart::where('user_id', auth()->id())->get();
            $cartCount = $cart->count();

            // Count the number of favorite products
            $favoriteCount = $favorites->count();
        }

        return view('home.shop', compact('favorites', 'products', 'cart', 'cartCount', 'categories', 'favoriteCount', 'productrand'));
    }

    public function contact()
    {
        $favorites = collect();
        $cart = collect();
        $cartCount = 0;
        $categories = Category::all();
        $favoriteCount = 0;

        // Check if the user is authenticated
        if (auth()->check()) {
            $favorites = auth()->user()->favorites()->get();

            // Retrieve the cart items for the authenticated user
            $cart = Cart::where('user_id', auth()->id())->get();
            $cartCount = $cart->count();

            // Count the number of favorite products
            $favoriteCount = $favorites->count();
        }

        return view('home.contact', compact('favorites', 'cart', 'cartCount', 'categories', 'favoriteCount'));
    }
}