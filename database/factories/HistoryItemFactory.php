<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryItem>
 */
class HistoryItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'header' => $this->faker->paragraph(1),
            'optional_text_one' => $this->faker->paragraph(3),          
            'image_path' => 'images/JPcyS870UvO895cdIUwLTaeCuM9q1Tc6kjy44TQT.png',
            'optional_text_two' => $this->faker->paragraph(3),
            'optional_footer' => $this->faker->paragraph(1),
            'date' => $this->faker->date(),
            'milestone' => $this->faker->boolean(),
            'contribution' => $this->faker->boolean()
        ];
    }
}
