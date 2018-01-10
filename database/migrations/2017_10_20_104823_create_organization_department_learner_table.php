<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationDepartmentLearnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       /*
        Schema::create('organization_department_learner', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organization_id');
            $table->integer('department_id')->nullable();
            $table->integer('learner_id');
            $table->integer('is_archived')->default(0);
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
        Schema::dropIfExists('organization_department_learner');
        */
    }
}
