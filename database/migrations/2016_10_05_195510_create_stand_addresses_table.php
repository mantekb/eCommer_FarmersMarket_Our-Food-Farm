<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stand_addresses', function (Blueprint $table) {
            $table->increments('id');
            //ID of stand we tie this to
            $table->integer('stand_id')->index()->unsigned();
            //Adress info
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            //$table->string('country');
            $table->string('lat');
            $table->string('long');
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
        Schema::drop('stand_addresses');
    }
}
