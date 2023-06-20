<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_name = $this->faker->unique()->words($nb=2,$asText = true);
        $slug = Str::slug($product_name, '-');
        return [
            // 'name' => $product_name,
            // 'slug' => $slug,
            // 'short_desc' => $this->faker->text(200),
            // 'desc' => $this->faker->text(500),
            // 'price' => $this->faker->numberBetween(70000, 300000),
            // 'qty' => $this->faker->numberBetween(10, 50),
            // 'image' => 'product-' . $this->faker->numberBetween(1, 16),
            // 'category_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
