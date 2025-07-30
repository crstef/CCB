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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('document_category_id')->constrained('document_categories')->onDelete('cascade');
            $table->integer('max_files')->default(1);
            $table->json('files')->nullable(); // Store file paths and metadata
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['document_category_id', 'is_active']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
