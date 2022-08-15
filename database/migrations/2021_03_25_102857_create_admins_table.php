<?php

use App\Models\Admin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('name');
            $table->enum('type', ['Admin', 'Printer', 'Delivery']);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->rememberToken();
            $table->timestamps();
        });

        Admin::create([
            'username' => 'Admin',
            'name' => 'مستخدم اول تجريبي',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'phone' => '0548888888',
            'type' => 'Admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
