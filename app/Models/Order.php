<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'country',
        'address',
        'city',
        'state',
        'postcode',
        'phone_number',
        'email',
        'product_title',
        'category',
        'discount_price',
        'image',
        'product_id',
        'quantity',
        'user_id',
        'razorpay_payment_id',
        // Add other attributes here as needed
    ];
}
