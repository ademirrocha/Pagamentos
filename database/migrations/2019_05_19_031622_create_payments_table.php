<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            
            $table->string('paymentId')->unique();
            $table->string('type');
            $table->string('cardNumber')->nullable();
            $table->string('brand', 30)->nullable();
            $table->integer('returnCode');
            $table->string('returnMessage');
            $table->string('status', 30);
            
            $table->integer('authorizationCode')->nullable();
            
            $table->integer('amount');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
