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
        Schema::create('reopens', function (Blueprint $table) {
            $table->id();
            // $table->boolean('re-assign');
            $table->foreignId('ticket_id')->constrained('tickets');
            $table->foreignId('user_id')->constrained('users');
            $table->longText('reason');

            $table->string('status')->nullable();
            // $table->string('priority')->default('Unset');
            $table->string('response')->nullable();
            // $table->dateTime('dateReopened');
            $table->dateTime('dateResponded')->nullable();
            // $table->dateTime('dateResolved')->nullable();
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
        Schema::dropIfExists('reopens');
    }
};
