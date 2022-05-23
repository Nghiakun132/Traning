<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_order_details', function (Blueprint $table) {
            $table->integer('order_id')->index()->unique();
            $table->integer('detail_line');
            $table->string('product_id', 50);
            $table->integer('quantity');
            $table->integer('price_buy');
            $table->string('shop_id');
            $table->integer('receiver_id');
            $table->primary(['order_id' , 'detail_line']);
            $table->timestamps();
        });
    }

    //     order_id
    // detail_line
    // product_id
    // price_buy
    // quantity
    // shop_id
    // receiver_id
    // created_at
    // updated_at

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mst_order_details');
    }
};
