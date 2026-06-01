<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evaluation_queries', function (Blueprint $table) {
            $table->id();
            $table->string('query');
            $table->json('expected_document_ids'); // Array of relevant document IDs
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluation_queries');
    }
};
