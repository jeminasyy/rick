<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            // $table->foreignId('categ_id')->constrained('categs')->default(1);
            // $table->string('categ_id')->foreign()->constrained('categs')->nullable()->default(null)->change();
            // $table->string('year');
            $table->string('categ_id');
            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('role');
            $table->string('register_token')->nullable();
            $table->boolean('verified');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1;");
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
