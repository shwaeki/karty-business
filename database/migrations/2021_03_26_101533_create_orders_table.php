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
            $table->id();
            $table->longText('html');
            $table->integer('quantity');
            $table->enum('status',['Pending','Preparation','Printing','Delivering','Delivered','NotReceived'])->default('Pending');
            $table->float('cost');
            $table->float('profit');
            $table->unsignedBigInteger('card');
            $table->foreign('card')->references('id')->on('cards')->onDelete('cascade');
            $table->unsignedBigInteger('user');
            $table->foreign('user')->references('id')->on('users')->onDelete('cascade');
            $table->text('notes')->nullable();
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
