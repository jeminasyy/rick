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
        Schema::create('reopenratings', function (Blueprint $table) {
            $table->id();
            $table->char('student_id')->foreign()->references('id')->on('students');
            $table->foreignId('reopen_id')->constrained('reopens');
            $table->integer('rating');
            $table->boolean('satisfied');
            $table->longText('comments')->nullable();
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
        Schema::dropIfExists('reopenratings');
    }
};
