<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'is_correct' => false,
        ];
    }

    public function correct()
    {
        return $this->state(function () {
            return ['is_correct' => true];
        });
    }

}
