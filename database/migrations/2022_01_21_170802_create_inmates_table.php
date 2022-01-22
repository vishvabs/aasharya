<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('district_id');
            $table->integer('ulb_id');
            $table->integer('suh_id');
            $table->string('genid');
            $table->string('name');
            $table->boolean('gender')->nullable();
            $table->integer('category')->nullable();
            $table->integer('type')->nullable();
            $table->integer('age')->nullable();
            $table->boolean('special_abled')->nullable();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('idistrict')->nullable();
            $table->string('pin')->nullable();
            $table->integer('id_type')->nullable();
            $table->string('id_no')->nullable();
            $table->string('birthmark')->nullable();
            $table->string('know_person')->nullable();
            $table->string('know_mobile')->nullable();
            $table->boolean('vaccinated')->nullable();
            $table->string('desc')->nullable();
            $table->string('photo')->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('inmates');
    }
}
