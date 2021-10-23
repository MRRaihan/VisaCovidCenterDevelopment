<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoostersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boosters', function (Blueprint $table) {
            $table->id();
            $table->string('name_of_vaccine');
            $table->string('registration_type')->default('normal');
            $table->date('date');
            $table->string('antibody_last_date');
            $table->unsignedBigInteger('users_id')->nullable();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->enum('status', [0,1]);
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
        Schema::dropIfExists('boosters');
    }
}
