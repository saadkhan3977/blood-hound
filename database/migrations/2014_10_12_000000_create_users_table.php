<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            // $table->string('from')->nullable();
            // $table->string('live_in')->nullable();
            // $table->string('work')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            // $table->string('phone2')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_code')->nullable();
            $table->string('password');
            // $table->string('country_code')->nullable();
            $table->string('photo')->nullable();
            $table->enum('role',['user','admin'])->default('user');
            $table->enum('status',['active','inactive'])->default('active');
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
