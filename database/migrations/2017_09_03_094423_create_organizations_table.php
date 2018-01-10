<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations',function (Blueprint $table){

            $table->increments('id');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('contact_person');
            $table->string('email')->nullable();
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
        Schema::dropIfExists('organizations');
    }
}
