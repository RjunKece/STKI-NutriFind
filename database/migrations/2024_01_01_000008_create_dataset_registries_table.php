<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dataset_registries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('provider');
            $table->string('source_url')->nullable();
            $table->unsignedInteger('total_documents')->default(0);
            $table->json('categories')->nullable();
            $table->unsignedInteger('vocabulary_size')->default(0);
            $table->unsignedInteger('indexed_documents')->default(0);
            $table->timestamp('last_indexed_at')->nullable();
            $table->string('status')->default('active'); // active, inactive, archived
            $table->string('version')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dataset_registries');
    }
};
