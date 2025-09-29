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
        Schema::table('competitional_events', function (Blueprint $table) {
            $table->string('link_inscriere_caniva')->nullable()->after('colaborare');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competitional_events', function (Blueprint $table) {
            $table->dropColumn('link_inscriere_caniva');
        });
    }
};