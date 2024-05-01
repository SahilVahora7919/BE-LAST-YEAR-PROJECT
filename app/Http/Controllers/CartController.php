<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function updateCartItem(Request $request, $id) {
        $car = Cart::findOrFail($id);
        
        // If "+" button is clicked
        if ($request->has('increase')) {
            $cart->quantity += 1;
        } 
        // If "-" button is clicked
        elseif ($request->has('decrease') && $cart->quantity > 1) {
            $cart->quantity -= 1;
        }

        $cart->total_price = $cart->price * $cart->quantity;
        $cart->save();

        // Recalculate total price and tax
        $totalPrice = Cart::sum('total_price');
        $tax = ($totalPrice * 13) / 100;

        // Redirect back to the previous page
        return redirect()->back()->with(['totalPrice' => $totalPrice, 'tax' => $tax]);
    }
}
