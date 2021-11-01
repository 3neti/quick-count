<?php

namespace Database\Factories;

use App\Models\{Contact, Station};
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
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobile' => $this->faker->phoneNumber(),
            'station_id' => Station::factory()->create()->id,
        ];
    }
}
