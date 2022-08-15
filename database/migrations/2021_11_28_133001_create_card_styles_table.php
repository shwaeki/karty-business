<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardStylesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_styles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('card');
            $table->foreign('card')->references('id')->on('cards')->onDelete('cascade');
            $table->longText('html');
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
        Schema::dropIfExists('card_styles');
    }
}
