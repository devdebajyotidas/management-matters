<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentLearnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      /*
        Schema::create('department_learner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('department_id');
            $table->integer('learner_id');
            $table->timestamps();
        });
      */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*
        Schema::dropIfExists('department_learner');
        */
    }
}
