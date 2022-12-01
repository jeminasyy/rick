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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categ_id')->constrained('categs');
            $table->foreignId('user_id')->constrained('users');
            $table->char('student_id')->foreign()->references('id')->on('students');
            $table->string('year');
            $table->string('assignee');
            $table->string('department');
            $table->longText('description');
            
            $table->string('status')->default('New');
            $table->string('priority')->default('Unset');
            $table->string('response')->nullable();
            // $table->integer('timesReopened')->default(0);
            // $table->dateTime('dateSubmitted');
            $table->dateTime('dateResponded')->nullable();
            $table->dateTime('dateResolved')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
