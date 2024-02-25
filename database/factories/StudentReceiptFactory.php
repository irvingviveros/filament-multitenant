<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Receipt;
use App\Models\Student;
use App\Models\StudentReceipt;
use App\Models\Team;

class StudentReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StudentReceipt::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sheet_id' => $this->faker->numberBetween(-10000, 10000),
            'receipt_id' => Receipt::factory(),
            'student_id' => Student::factory(),
            'created_by' => $this->faker->numberBetween(-10000, 10000),
            'modified_by' => $this->faker->numberBetween(-10000, 10000),
            'team_id' => Team::factory(),
        ];
    }
}
