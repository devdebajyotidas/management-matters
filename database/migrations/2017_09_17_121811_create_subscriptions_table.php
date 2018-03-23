<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('account_id');
            $table->string('account_type');
            $table->string('subscription_id')->nullable();
            $table->dateTime('start_date')->default(\Carbon\Carbon::now());
            $table->integer('billing_interval')->default(30);
            $table->integer('licenses')->default(1);
            $table->integer('status')->default(1);
            $table->integer('amount')->nullable();
            $table->integer('is_subscribed')->default(0);
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
        Schema::dropIfExists('subscriptions');
    }
}
