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
        Schema::create('mst_products', function (Blueprint $table) {
            $table->string('product_id', 20)->primary()->index()->unique();
            $table->string('product_name');
            $table->string('product_image')->nullable();
            $table->integer('product_quantity');
            $table->decimal('product_price', 12, 2)->default(0);
            $table->tinyInteger('is_sales')->default(1);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('mst_products');
    }
};
