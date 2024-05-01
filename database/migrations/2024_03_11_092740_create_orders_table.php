<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('country');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('postcode');
            $table->string('phone_number');
            $table->string('email');

            $table->string('product_title');
            $table->string('category');
            $table->string('discount_price');
            $table->string('image');
            $table->string('product_id');
            $table->string('weight');
            $table->string('quantity');

            $table->string('payment_status');
            $table->string('delivery_status');
            $table->decimal('total_price', 10, 2);
            $table->decimal('itemTotalPrice')->default(0);
            $table->string('razorpay_payment_id')->nullable()->default(null);
            $table->decimal('tax', 10, 2);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
