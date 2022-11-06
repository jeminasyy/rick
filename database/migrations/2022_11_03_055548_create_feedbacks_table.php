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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->uuid('id');
            $table->char('student_id')->foreign()->references('id')->on('students');
            $table->string('ticket_id')->foreign()->references('id')->on('tickets');
            // $table->foreignId('ticket_id')->constrained('tickets');
            $table->integer('rating');
            $table->longText('comments')->nullable();
            $table->timestamps();
        });
        // DB::statement("ALTER TABLE feedbacks AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
};
