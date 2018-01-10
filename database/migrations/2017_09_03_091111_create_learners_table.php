<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learners',function (Blueprint $table){

            $table->increments('id');
            $table->integer('department_id')->nullable();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('name_on_card')->nullable();
            $table->string('card_number')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('cvv')->nullable();
            //More fields to be added here

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
        Schema::dropIfExists('learners');
    }
}
