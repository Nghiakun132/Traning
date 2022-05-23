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
        Schema::create('mst_orders', function (Blueprint $table) {
            $table->integer('order_id',true)->index()->unique();
            $table->string('order_shop',40);
            $table->integer('customer_id');
            $table->integer('total_price');
            $table->tinyInteger('payment_method');
            $table->integer('ship_charge');
            $table->integer('tax');
            $table->datetime('order_date');
            $table->datetime('shipment_date');
            $table->datetime('cancel_date');
            $table->tinyInteger('order_status')->default(1);
            $table->string('note_customer')->nullable();
            $table->string('error_code_api',20)->nullable();
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
        Schema::dropIfExists('mst_orders');
    }
};
