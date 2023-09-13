<?php

namespace Database\Factories;

use App\Models\Category;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
        $title = fake()->name();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => fake()->text(300),
            'created_at' => fake()->dateTimeBetween('-6 months'),
        ];
    }
}
