<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->index()->unsigned();
            //Product information, saved for redundancy in case owner changed it.
            $table->integer('quantity');
            //Not index'd as we don't tie it in to the actual table.
            $table->integer('product_id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price'); //unit price
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
        Schema::drop('order_items');
    }
}
