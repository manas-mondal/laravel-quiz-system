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
        Schema::create('mcqs', function (Blueprint $table) {
            $table->id();
            $table->text('question');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_option');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('quiz_id');
            $table->timestamps();
            $table->foreign('admin_id')->references('id')->on('admins')->nullOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcqs');
    }
};
