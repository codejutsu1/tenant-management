<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender');
            $table->boolean('status')->default(0);
            $table->boolean('paid')->default(0)->nullable();
            $table->string('year')->nullable();
            $table->string('room_no')->nullable();
            $table->string('role_id');
            $table->string('lodge_no')->nullable();
            $table->string('type');
            $table->string('lga');
            $table->string('state');
            $table->string('occupation');
            $table->date('dob')->nullable();
            $table->string('phone');
            $table->timestamp('date_left')->nullable();
            $table->timestamp('rent_due')->nullable();
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
};
