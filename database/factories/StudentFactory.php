<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\Team;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'national_id' => $this->faker->word(),
            'enrollment' => $this->faker->word(),
            'admission_no' => $this->faker->word(),
            'admission_date' => $this->faker->date(),
            'payment_reference' => $this->faker->word(),
            'first_name' => $this->faker->firstName(),
            'paternal_surname' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'maternal_surname' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'birth_date' => $this->faker->date(),
            'occupation' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'nationality' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'personal_email' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'personal_phone' => $this->faker->word(),
            'marital_status' => $this->faker->word(),
            'address' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'street_number' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'interior_number' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'neighborhood' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'between_streets' => $this->faker->regexify('[A-Za-z0-9]{200}'),
            'zip' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'state' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'inscription_date' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'sex' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'gender' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'blood_group' => $this->faker->regexify('[A-Za-z0-9]{15}'),
            'allergies' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'ailments' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'guardian_relationship' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'status' => $this->faker->numberBetween(-8, 8),
            'team_id' => Team::factory(),
            'user_id' => ::factory(),
            'guardian_id' => Guardian::factory(),
            'scholarship_id' => $this->faker->numberBetween(-10000, 10000),
            'career_id' => $this->faker->numberBetween(-10000, 10000),
            'created_by' => $this->faker->numberBetween(-10000, 10000),
            'modified_by' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
