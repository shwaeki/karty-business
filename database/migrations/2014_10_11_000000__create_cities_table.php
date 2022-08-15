<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
        });

        $cities = ['القدس', 'رام الله والبيرة', 'جنين', 'طولكرم', 'أريحا', 'الخليل', 'بيت لحم', 'نابلس', 'قلقيلية', 'سلفيت', 'طوباس'];

        foreach ($cities as $city) {
            City::create([
                'name' => $city,
                'price' => 0,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}


