<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('card');
            $table->boolean('loved')->default(false);
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('card')->references('id')->on('cards')->onDelete('cascade');
            $table->longText('html')->nullable();
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
        Schema::dropIfExists('likes');
    }
}
