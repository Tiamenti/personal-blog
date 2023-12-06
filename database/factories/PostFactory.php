<?php

namespace Database\Factories;

use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Orchid\Attachment\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $file = new UploadedFile($this->faker->image, $this->faker->word . '.jpg');
        $attachment = (new File($file))->load();

        return [
            'category_id' => PostCategory::inRandomOrder()->first()->id,
            'title' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug,
            'content' => $this->faker->text,
            'image' => $attachment->relativeUrl,
            'is_published' => $this->faker->numberBetween(0, 100) > 5,
        ];
    }
}
