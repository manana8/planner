<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_history', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_of_history_create');
            $table->integer('task_id')->unsigned()->nullable();
            $table->string('title_before');
            $table->string('text_before');
            $table->integer('category_id_before')->unsigned()->nullable();
            $table->dateTime('deadline_before');
            $table->string('status_before');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('category_id_before')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_history');
    }
};
