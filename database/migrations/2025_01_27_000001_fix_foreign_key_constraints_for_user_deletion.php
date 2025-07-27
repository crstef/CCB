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
        // First, make author_id nullable in pages table
        Schema::table('pages', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->change();
        });

        // Drop the existing foreign key constraint and recreate with onDelete('set null')
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });

        // First, make author_id nullable in posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('author_id')->nullable()->change();
        });

        // Drop the existing foreign key constraint and recreate with onDelete('set null')
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the original foreign key constraints without onDelete behavior
        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedBigInteger('author_id')->nullable(false)->change();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedBigInteger('author_id')->nullable(false)->change();
        });
    }
};
