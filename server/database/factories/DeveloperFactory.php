<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'sexo' => $this->faker->randomElement($array = array ('F', 'M')),
            'idade' => $this->faker->randomDigit,
            'hobby' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'data_nascimento' => $this->faker->date($format = 'Y-m-d', $max = 'now')
        ];
    }
}
