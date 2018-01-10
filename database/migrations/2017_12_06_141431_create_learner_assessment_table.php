<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearnerAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learner_assessment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('learner_id');
            $table->integer('learning_id');
            $table->text('assessment_score');
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
        Schema::dropIfExists('learner_assessment');
    }
}
