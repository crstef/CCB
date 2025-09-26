<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Folosesc SQL direct pentru a forța modificarea coloanelor
        DB::statement('ALTER TABLE features MODIFY COLUMN description TEXT NULL');
        DB::statement('ALTER TABLE features MODIFY COLUMN icon VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE features MODIFY COLUMN description TEXT NOT NULL');
        DB::statement('ALTER TABLE features MODIFY COLUMN icon VARCHAR(255) NOT NULL');
    }
};