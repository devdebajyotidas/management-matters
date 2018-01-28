<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostOfNotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cost_of_not', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('learner_id');
            $table->text('name');
            $table->text('hourly_wage');
            $table->text('emp_num');
            $table->text('lost_hours');
            $table->integer('total');
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
        Schema::dropIfExists('cost_of_not');
    }
}
