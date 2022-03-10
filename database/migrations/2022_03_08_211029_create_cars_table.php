<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->integer('carmodel_id');
            $table->integer('engine_id');
            $table->string('color');
            $table->text('details');
            $table->boolean('has_gas_economy');
            $table->boolean('has_abs');
            $table->enum('doors',[2,4]);
            $table->integer('max_speed');
            $table->enum('transimation',['manual','auto','cvt']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
