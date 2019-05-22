<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_api', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cpf');
            $table->string('token');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

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
        Schema::dropIfExists('users_api');
    }
}
