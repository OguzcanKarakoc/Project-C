<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');

            $table->unsignedInteger('order_status_id');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('cascade');

            $table->unsignedInteger('shipment_id');
            $table->foreign('shipment_id')->references('id')->on('shipments')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
}
