<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            // Pregunta a la que pertenece
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            // Texto de la respuesta posible
            $table->string('answer_text');
            // Indica si es la respuesta correcta
            $table->boolean('is_correct')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
