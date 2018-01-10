<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets',function (Blueprint $table){
            $table->increments('id');
            $table->integer('learner_id');
            $table->integer('learning_id');
            $table->string('title');
            $table->string('impact_level');
            $table->integer('is_archived')->default(0);
            $table->integer('is_completed')->default(0);

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
        Schema::dropIfExists('tickets');
    }
}
