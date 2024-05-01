<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RazorpayController extends Controller
{
    public function processToPay(Request $request)
    {
        $user = Auth::user();
        $userId = $user->id;

        // Retrieve cart items for the user
        $cartItems = Cart::where('user_id', $userId)->get();

        // Check if cart is empty
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty. Please add products before placing an order.');
        }

        $totalPrice = 0;

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

        // Process each cart item
        $totalPrice = 0;
        foreach ($cartItems as $cartItem) {
            $itemTotalPrice = $cartItem->price * $cartItem->quantity;
            $tax = ($itemTotalPrice * 13) / 100;
            $totalPrice += $itemTotalPrice + $tax;
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
            $order->payment_status = 'Razorpay';
            $order->delivery_status = 'Processing';

            // Calculate tax and total price
            $tax = ($itemTotalPrice * 13) / 100;
            $order->tax = $tax;
            $order->total_price = $itemTotalPrice + $tax;

            // // Save the order
            // $order->save();

            // // Update product quantity
            // $product = Product::find($cartItem->product_id);
            // $product->quantity -= 1;
            // $product->save();

            // // Delete the item from cart
            // $cartItem->delete();
        }

        // Return the first_name along with other necessary data
        return response()->json([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'country' => $request->input('country'),
            'address' => $request->input('address'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'postcode' => $request->input('postcode'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'total_price' => $totalPrice,
            'message' => 'Order placed successfully!'
        ]);
    }
    public function storeOrderData(Request $request)
{
    $user = Auth::user();
    $userId = $user->id;

    // Retrieve cart items for the user
    $cartItems = Cart::where('user_id', $userId)->get();

    // Check if cart is empty
    if ($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty. Please add products before placing an order.');
    }

    // Proceed to create order
    foreach ($cartItems as $cartItem) {
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
        $order->payment_status = 'Razorpay';
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
    return response()->json(['message' => 'Order data stored successfully']);
}


}