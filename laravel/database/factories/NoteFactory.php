<?php

namespace Database\Factories;

use DavidBadura\FakerMarkdownGenerator\FakerProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker->addProvider(new FakerProvider($this->faker));

        return [
            'title' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'body' => $this->faker->markdown()
        ];
    }
}
