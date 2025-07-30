<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, ensure document_categories table exists and has data
        if (!Schema::hasTable('document_categories')) {
            throw new \Exception('document_categories table must exist before running this migration. Run DocumentCategorySeeder first.');
        }

        // Check if documents table still has the old 'category' column
        if (Schema::hasColumn('documents', 'category')) {
            // Add the new column first
            Schema::table('documents', function (Blueprint $table) {
                $table->foreignId('document_category_id')->nullable()->after('description');
            });

            // Migrate existing data
            $documents = DB::table('documents')->get();
            foreach ($documents as $document) {
                $categoryName = $document->category;
                $category = DocumentCategory::where('name', $categoryName)->first();
                
                if ($category) {
                    DB::table('documents')
                        ->where('id', $document->id)
                        ->update(['document_category_id' => $category->id]);
                } else {
                    // Create a new category if it doesn't exist
                    $newCategory = DocumentCategory::create([
                        'name' => $categoryName,
                        'description' => "Auto-created from existing document: {$categoryName}",
                        'color' => '#6B7280',
                        'sort_order' => 999,
                        'is_active' => true,
                    ]);
                    
                    DB::table('documents')
                        ->where('id', $document->id)
                        ->update(['document_category_id' => $newCategory->id]);
                }
            }

            // Make the foreign key required and add constraint
            Schema::table('documents', function (Blueprint $table) {
                $table->foreignId('document_category_id')->nullable(false)->change();
                $table->foreign('document_category_id')->references('id')->on('document_categories')->onDelete('cascade');
            });

            // Drop the old category column
            Schema::table('documents', function (Blueprint $table) {
                $table->dropColumn('category');
            });

            // Add the indexes
            Schema::table('documents', function (Blueprint $table) {
                $table->index(['document_category_id', 'is_active']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->string('category')->default('General')->after('description');
            $table->dropForeign(['document_category_id']);
            $table->dropIndex(['document_category_id', 'is_active']);
            $table->dropColumn('document_category_id');
        });
    }
};
