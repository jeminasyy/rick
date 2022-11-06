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
        Schema::create('tickets', function (Blueprint $table) {
            $table->uuid('id');
            // $table->foreignId('categ_id')->constrained('categs');
            // $table->foreignId('user_id')->constrained('users');
            $table->uuid('categ_id')->foreign()->references('id')->on('categs');
            $table->uuid('user_id')->foreign()->references('id')->on('users');
            $table->char('student_id')->foreign()->references('id')->on('students');
            $table->string('year');
            $table->string('department');
            $table->longText('description');
            $table->string('status')->default('New');
            $table->string('priority')->default('Unset');
            $table->string('response')->nullable();
            $table->integer('timesReopened')->default(0);
            $table->dateTime('dateSubmitted');
            $table->dateTime('dateResponded')->nullable();
            $table->dateTime('dateResolved')->nullable();
            $table->timestamps();
        });
        // DB::statement("ALTER TABLE tickets AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
