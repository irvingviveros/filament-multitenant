<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Career;
use App\Models\Team;

class CareerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Career::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'enrollment' => $this->faker->regexify('[A-Za-z0-9]{6}'),
            'description' => $this->faker->text(),
            'opening_date' => $this->faker->date(),
            'status' => $this->faker->word(),
            'created_by' => $this->faker->numberBetween(-10000, 10000),
            'modified_by' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
