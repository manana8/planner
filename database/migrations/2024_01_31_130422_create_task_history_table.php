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
        Schema::create('task_histories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('data_of_history_create');
            $table->integer('task_id');
            $table->string('title_before')->nullable();
            $table->string('text_before')->nullable();
            $table->integer('category_id_before')->nullable();
            $table->dateTime('deadline_before')->nullable();
            $table->string('status_before')->nullable();
            $table->string('type');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('category_id_before')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_histories');
    }
};
