<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersAndOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('cart_id')->constrained('carts');
            $table->boolean('is_shipped')->default(0);
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('orders');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table)
        {
            $table->dropForeign('orders_cart_id_foreign');
            $table->dropForeign('orders_user_id_foreign');
        });
        Schema::table('order_items', function (Blueprint $table)
        {
            $table->dropForeign('order_items_order_id_foreign');
            $table->dropForeign('order_items_product_id_foreign');
        });
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
}
