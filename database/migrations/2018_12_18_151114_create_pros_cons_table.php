<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProsConsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pros_cons', function (Blueprint $table) {
            $table->increments('id');

            $table->text("text");
            $table->boolean("vote");

            $table->unsignedInteger('rating_id');
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pros_cons');
    }
}
