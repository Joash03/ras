<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('subtotal');
            $table->string('total');
            $table->string('month');
            $table->integer('payment_method')->comment('0 => cash, 1 => flutterwave, 2 => paystack, 3 => bank_transfer, 4 => card');
            $table->integer('payment_status')->comment('0 => failed, 1 => success, 2 => pending');
            $table->string('reference');
            $table->string('channel');
            $table->string('transaction_date');
            $table->integer('order_status')->comment('0 => pending, 1 => completed, 2 => canceled');
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
