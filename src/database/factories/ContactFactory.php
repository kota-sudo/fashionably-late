<?php

namespace Database\Factories;

use App\Models\Contact;
use Faker\Generator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * @var Generator|null
     */
    protected static $jaFaker;

    /**
     * @return Generator
     */
    protected function jaFaker()
    {
        if (static::$jaFaker === null) {
            static::$jaFaker = \Faker\Factory::create('ja_JP');
        }

        return static::$jaFaker;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = $this->jaFaker();

        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'gender' => $this->faker->randomElement([1, 2, 3]),
            'email' => $faker->unique()->safeEmail(),
            'tel' => preg_replace('/\D/', '', $faker->phoneNumber()),
            'address' => $faker->prefecture() . $faker->city() . $faker->streetAddress(),
            'building' => $faker->optional()->secondaryAddress(),
            'detail' => $faker->text(200),
        ];
    }
}
