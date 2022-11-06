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
        Schema::create('schoolterms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('term');
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE schoolterms AUTO_INCREMENT = 1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schoolterms');
    }
};
