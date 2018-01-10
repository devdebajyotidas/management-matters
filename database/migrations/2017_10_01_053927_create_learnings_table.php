<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLearningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learnings',function (Blueprint $table){

            $table->increments('id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->longText('introduction')->nullable();
            $table->text('highlights')->nullable();
            $table->longText('chapters')->nullable();
            $table->longText('assessments')->nullable();
            $table->longText('quiz')->nullable();
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
        Schema::dropIfExists('learnings');
    }
}
