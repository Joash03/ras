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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('category_id');
            $table->bigInteger('supplier_id');
            $table->string('code');
            $table->string('thumbnail');
            $table->text('description')->nullable();
            $table->text('purchase_date');
            $table->string('expiry_date');
            $table->text('purchase_price');
            $table->string('sales_price');
            $table->enum('status',['0','1']);
            $table->integer('stock');
            $table->integer('stock_status')->comment('0 => out of stock, 1 => in stock, 2 => expired');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
