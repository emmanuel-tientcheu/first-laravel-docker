<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::whereState(1)->inRandomOrder()->first();
        $created = $this->faker->dateTimeThisDecade;
        $end = $this->faker->dateTimeBetween($created, '+1 year');
        return [
            //
            'task' => $this->faker->text(rand(15,30)),
            'status' => $this->faker->randomElement([0,1]),
            'created' => $created->format('Y-m-d H:i:s'),
            'end' => $end->format('Y-m-d H:i:s'),
            'user_id' => $user->id,
        ];
    }
}
