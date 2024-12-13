<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // Generate 50 fake customers
            DB::table('customers')->insert([
                'title' => $faker->randomElement(['Herr', 'Frau']),
                'company' => $faker->company,
                'name' => $faker->firstName,
                'surname' => $faker->lastName,
                'address' => $faker->streetAddress,
                'po_box' => $faker->optional()->postcode,
                'zip' => $faker->postcode,
                'city' => $faker->city,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('076 683 99 93'),
                'iban' => $faker->numerify('CH43 8000 8000 8000 8000 8'),
                'bankname' => $faker->company,
                'alt_title' => $faker->optional()->randomElement(['Herr', 'Frau']),
                'alt_name' => $faker->optional()->firstName,
                'alt_surname' => $faker->optional()->lastName,
                'alt_address' => $faker->optional()->streetAddress,
                'alt_zip' => $faker->optional()->postcode,
                'alt_city' => $faker->optional()->city,
                'oral_suggestion' => $faker->randomElement(['Ja', 'Nein']),
                'incorporated' => $faker->boolean, // 0 or 1
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
