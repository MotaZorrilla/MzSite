<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MasonicWork;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasonicWork>
 */
class MasonicWorkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MasonicWork::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'file_path' => 'masonic_works/' . $this->faker->uuid() . '.pdf',
            'is_public' => $this->faker->boolean(),
            'description' => $this->faker->paragraph(),
            'required_degree' => 'Aprendiz',
        ];
    }
}
