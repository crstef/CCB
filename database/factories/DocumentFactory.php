<?php

namespace Database\Factories;

use App\Models\Document;
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
        $categories = array_keys(Document::getCategories());
        
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'category' => $this->faker->randomElement($categories),
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
     * Set a specific category.
     */
    public function category(string $category): Factory
    {
        return $this->state(function (array $attributes) use ($category) {
            return [
                'category' => $category,
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
