<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * MediaFactory
 * 
 * Factory for generating test media data
 * 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $mediaType = $this->faker->randomElement(['image', 'video']);
        $extension = $mediaType === 'image' ? 'jpg' : 'mp4';
        $fileName = $this->faker->slug() . '.' . $extension;
        
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'file_name' => $fileName,
            'file_path' => "gallery/{$mediaType}s/{$fileName}",
            'file_size' => $mediaType === 'image' 
                ? $this->faker->numberBetween(500000, 3000000) 
                : $this->faker->numberBetween(5000000, 50000000),
            'mime_type' => $mediaType === 'image' ? 'image/jpeg' : 'video/mp4',
            'media_type' => $mediaType,
            'category' => $this->faker->randomElement(array_keys(Media::CATEGORIES)),
            'is_featured' => $this->faker->boolean(20), // 20% chance of being featured
            'is_visible' => $this->faker->boolean(90), // 90% chance of being visible
            'sort_order' => $this->faker->numberBetween(0, 100),
            'alt_text' => $this->faker->sentence(2),
            'tags' => $this->faker->randomElements([
                'bodybuilding', 'training', 'competition', 'members', 
                'gym', 'fitness', 'events', 'team', 'workout'
            ], $this->faker->numberBetween(1, 4)),
            'metadata' => [
                'width' => $mediaType === 'image' ? $this->faker->numberBetween(1200, 1920) : 1920,
                'height' => $mediaType === 'image' ? $this->faker->numberBetween(800, 1080) : 1080,
                'duration' => $mediaType === 'video' ? $this->faker->numberBetween(30, 300) : null,
                'format' => $extension,
                'created_by' => 'factory',
            ],
        ];
    }

    /**
     * Indicate that the media should be featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
            'sort_order' => $this->faker->numberBetween(1, 10),
        ]);
    }

    /**
     * Indicate that the media should be hidden.
     */
    public function hidden(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_visible' => false,
        ]);
    }

    /**
     * Indicate that the media is an image.
     */
    public function image(): static
    {
        $fileName = $this->faker->slug() . '.jpg';
        
        return $this->state(fn (array $attributes) => [
            'file_name' => $fileName,
            'file_path' => "gallery/images/{$fileName}",
            'file_size' => $this->faker->numberBetween(500000, 3000000),
            'mime_type' => 'image/jpeg',
            'media_type' => 'image',
            'metadata' => [
                'width' => $this->faker->numberBetween(1200, 1920),
                'height' => $this->faker->numberBetween(800, 1080),
                'format' => 'jpg',
                'created_by' => 'factory',
            ],
        ]);
    }

    /**
     * Indicate that the media is a video.
     */
    public function video(): static
    {
        $fileName = $this->faker->slug() . '.mp4';
        
        return $this->state(fn (array $attributes) => [
            'file_name' => $fileName,
            'file_path' => "gallery/videos/{$fileName}",
            'file_size' => $this->faker->numberBetween(5000000, 50000000),
            'mime_type' => 'video/mp4',
            'media_type' => 'video',
            'metadata' => [
                'width' => 1920,
                'height' => 1080,
                'duration' => $this->faker->numberBetween(30, 300),
                'format' => 'mp4',
                'created_by' => 'factory',
            ],
        ]);
    }

    /**
     * Set a specific category.
     */
    public function category(string $category): static
    {
        return $this->state(fn (array $attributes) => [
            'category' => $category,
        ]);
    }
}
