<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuizMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();
            $table->enum('status', ['publish', 'draft', 'passive'])->default('draft');
            $table->timestamp('finished_at')->nullable();
            $table->unsignedBigInteger('admin_who_created')->nullable();
            $table->unsignedBigInteger('admin_who_update')->nullable();
            $table->timestamps();

            $table->foreign('admin_who_created')->references('id')->on('users');
            $table->foreign('admin_who_update')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizzes');
    }
}
