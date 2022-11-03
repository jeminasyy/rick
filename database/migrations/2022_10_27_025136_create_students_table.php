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
        Schema::create('students', function (Blueprint $table) {
            $table->char('id',9)->primary();
            $table->string('email');
            $table->string('FName')->nullable();
            $table->string('LName')->nullable();
            $table->string('studNumber')->nullable();
            $table->integer('tickets');
            $table->integer('ongoingTickets');
            $table->string('code')->nullable();
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
        Schema::dropIfExists('students');
    }
};
