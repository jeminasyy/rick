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
            $table->json('categ_id')->foreign()->constrained('categs')->nullable()->default(null)->change();
            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('role');
            $table->string('register_token')->nullable();
            $table->boolean('verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // $table->foreignId('categ_id')->constrained('categs');
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
