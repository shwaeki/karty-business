<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('path');
            $table->text('description')->nullable();
            $table->float('price')->nullable();
            $table->float('cost')->nullable();
            $table->integer('discount')->default(0);
            $table->float('height')->nullable();
            $table->float('width')->nullable();
            $table->integer('minimum')->nullable();
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('category')->nullable();
            $table->foreign('category')->references('id')->on('categories')->onDelete('SET NULL');
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
        Schema::dropIfExists('cards');
    }
}
