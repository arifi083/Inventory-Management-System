<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saleries', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('amount')->nullable();
            $table->string('salary_date')->nullable();
            $table->string('salary_month')->nullable();
            $table->string('salary_year')->nullable();
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
        Schema::dropIfExists('saleries');
    }
}
