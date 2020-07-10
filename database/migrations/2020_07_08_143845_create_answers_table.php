<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('untuk_pertanyaan_id');
            $table->foreign('untuk_pertanyaan_id')->references('id')->on('questions');
            $table->unsignedBigInteger('pembuat_jawaban_id');
            $table->foreign('pembuat_jawaban_id')->references('id')->on('users');
            $table->text('content');
            $table->tinyInteger('is_selected')->default('0');
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
        Schema::dropIfExists('answers');
    }
}
