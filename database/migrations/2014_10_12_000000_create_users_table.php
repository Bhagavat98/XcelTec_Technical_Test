<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('user_role_id', ['0', '1', '2','3','4']);
            $table->string('firstname');
            $table->string('lastname');
            $table->date('dob'); //y-m-d
            $table->bigInteger('phone_number')->unique(); // unique
            $table->string('email')->unique();
            $table->string('password');
            $table->string('profile_image',400)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_active', ['0', '1', '2',])->default('2'); // pending defu
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
