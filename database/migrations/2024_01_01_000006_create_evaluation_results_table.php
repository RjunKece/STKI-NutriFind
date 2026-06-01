<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evaluation_query_id')->constrained()->onDelete('cascade');
            $table->foreignId('retrieved_document_id')->constrained('foods')->onDelete('cascade');
            $table->integer('rank');
            $table->double('relevance_score');
            $table->boolean('is_relevant')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_results');
    }
};
