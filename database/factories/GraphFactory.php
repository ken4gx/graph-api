<?php

namespace Database\Factories;

use App\Models\Graph;
use Illuminate\Database\Eloquent\Factories\Factory;

class GraphFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Graph::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'graph_name' => $this->faker->unique()->name,
            'graph_descrip'=> $this->faker->sentence(12)
        ];
    }
}
