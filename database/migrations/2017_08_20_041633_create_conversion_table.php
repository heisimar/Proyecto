<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversion', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('producto_id')->unsigned()->index();
            $table->foreign('producto_id')->references('id')->on('producto')->onDelete('cascade');

            $table->double('cnt_ini_prd');

            $table->integer('unidad_inicial_id')->unsigned()->index();
            $table->foreign('unidad_inicial_id')->references('id')->on('unidad')->onDelete('cascade');

            $table->double('cnt_fin_prd');

            $table->integer('unidad_final_id')->unsigned()->index();
            $table->foreign('unidad_final_id')->references('id')->on('unidad')->onDelete('cascade');

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
        Schema::dropIfExists('conversion');
    }
}
