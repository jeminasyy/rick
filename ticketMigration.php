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
            $table->foreignId('user_id')->constrained('users')->nullable();
            // $table->string('student_id');
            // $table->foreignId('student_id')->contrained();
            $table->char('student_id')->foreign()->constrained('students');
            // $table->string('studEmail');
            // $table->string('studFName');
            // $table->string('studLName');
            // $table->string('studNumber');
            $table->string('year');
            $table->string('department');
            $table->longText('description');
            // $table->string('category');
            $table->string('status');
            // $table->string('assignee')->nullable();
            // $table->string('assignedBy')->nullable();
            $table->string('solution')->nullable();
            $table->integer('timesReopened')->nullable();
            $table->dateTime('dateSubmitted');
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
