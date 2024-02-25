<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Receipt;

class ReceiptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Receipt::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sheet' => $this->faker->numberBetween(-10000, 10000),
            'payment_method' => $this->faker->word(),
            'payment_concept' => $this->faker->word(),
            'amount' => $this->faker->randomFloat(2, 0, 99999999.99),
            'amount_text' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'payment_date' => $this->faker->dateTime(),
            'note' => $this->faker->text(),
            'create_by' => $this->faker->numberBetween(-10000, 10000),
            'modified_by' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
