<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    protected $model = Document::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'document_category_id' => DocumentCategory::factory(),
            'max_files' => $this->faker->numberBetween(1, 5),
            'files' => null, // Will be populated separately if needed
            'is_active' => $this->faker->boolean(85), // 85% chance of being active
        ];
    }

    /**
     * Indicate that the document is active.
     */
    public function active(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => true,
            ];
        });
    }

    /**
     * Indicate that the document is inactive.
     */
    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'is_active' => false,
            ];
        });
    }

    /**
     * Set a specific category by ID.
     */
    public function categoryId(int $categoryId): Factory
    {
        return $this->state(function (array $attributes) use ($categoryId) {
            return [
                'document_category_id' => $categoryId,
            ];
        });
    }

    /**
     * Set a specific number of max files.
     */
    public function maxFiles(int $maxFiles): Factory
    {
        return $this->state(function (array $attributes) use ($maxFiles) {
            return [
                'max_files' => $maxFiles,
            ];
        });
    }
}
