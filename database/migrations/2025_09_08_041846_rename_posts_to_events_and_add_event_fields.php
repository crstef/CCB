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
        Schema::rename('posts', 'events');

        Schema::table('events', function (Blueprint $table) {
            if (Schema::hasColumn('events', 'category_id')) {
                // Drop foreign key if it exists, checking for its existence first
                $foreignKeys = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys('events');
                foreach ($foreignKeys as $foreignKey) {
                    if (in_array('category_id', $foreignKey->getLocalColumns())) {
                        $table->dropForeign(['category_id']);
                        break;
                    }
                }
                $table->dropColumn('category_id');
            }

            $table->string('location')->nullable()->after('body');
            $table->text('disciplines')->nullable()->after('location');
            $table->text('judges')->nullable()->after('disciplines');
            $table->date('event_start_date')->nullable()->after('judges');
            $table->date('booking_start_date')->nullable()->after('event_start_date');
            $table->date('booking_end_date')->nullable()->after('booking_start_date');
            $table->string('caniva_link')->nullable()->after('booking_end_date');
        });

        Schema::create('category_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_event');

        Schema::table('events', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->dropColumn([
                'location',
                'disciplines',
                'judges',
                'event_start_date',
                'booking_start_date',
                'booking_end_date',
                'caniva_link',
            ]);
        });

        Schema::rename('events', 'posts');
    }
};
