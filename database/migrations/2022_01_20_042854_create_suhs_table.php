<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('district_id');
            $table->integer('ulb_id');
            $table->string('genid');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('created_id')->nullable();
            $table->integer('updated_id')->nullable();
            $table->integer('suh_status')->nullable();
            $table->string('capacity')->nullable();
            $table->string('geo')->nullable();
            $table->integer('is_cctv')->nullable();
            $table->boolean('is_water')->nullable();
            $table->boolean('is_iso')->nullable();
            $table->string('hygiene')->nullable();
            $table->boolean('is_food')->nullable();
            $table->boolean('is_vaccination')->nullable();
            $table->string('sma_name')->nullable();
            $table->string('sma_payment')->nullable();
            $table->dateTime('created_date')->nullable();
            $table->dateTime('sma_date')->nullable();
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
        Schema::dropIfExists('suhs');
    }
}
