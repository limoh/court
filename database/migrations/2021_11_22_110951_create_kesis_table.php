<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kesis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('description');
            $table->date('filedate');
            $table->date('first_hearing');
            $table->date('next_hearing');
            $table->unsignedBigInteger('judge_id');
            $table->unsignedBigInteger('lawyer_id');
            $table->string('p_name');
            $table->string('p_email');
            $table->string('p_phone');
            $table->date('p_dob');
            $table->string('p_id');
            $table->enum('p_gender', ['male', 'female', 'other'])->nullable();
            $table->string('d_name');
            $table->string('d_email');
            $table->string('d_phone');
            $table->date('d_dob');
            $table->string('d_id');
            $table->enum('d_gender', ['male', 'female', 'other'])->nullable();
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
        Schema::dropIfExists('kesis');
    }
}
