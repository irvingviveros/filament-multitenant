<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Guardian;
use App\Models\User;

class GuardianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guardian::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'paternal_surname' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'maternal_surname' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'student_relationship' => $this->faker->word(),
            'address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'street_number' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'neighborhood' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'between_streets' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'zip' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'state' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'personal_email' => $this->faker->word(),
            'personal_phone' => $this->faker->word(),
            'user_id' => User::factory(),
            'created_by' => $this->faker->numberBetween(-10000, 10000),
            'modified_by' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
