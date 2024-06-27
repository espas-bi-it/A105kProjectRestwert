<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence($nbwords = 4, $variableNbWords = true),
            'name' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'surname' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'address' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'po_box' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'zip' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'city' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'email' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'phone' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'iban' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'bankname' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_title' => $this->faker->sentence($nbwords = 4, $variableNbWords = true),
            'alt_name' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_surname' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_address' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_po_box' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_zip' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_city' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_email' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_phone' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_iban' => $this->faker->sentence($nbwords = 2, $variableNbWords = true),
            'alt_bankname' => $this->faker->sentence($nbwords = 2, $variableNbWords = true)
        ];
    }
}
