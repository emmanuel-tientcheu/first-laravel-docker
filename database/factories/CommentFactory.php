<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
use App\Models\User;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $todo = Todo::whereStatus(1)->inRandomOrder()->first();
        $user = User::whereState(1)->inRandomOrder()->first();

        return [
            //
            'message' => $this->faker->text(rand(20,50)),
            'view' => $this->faker->randomElement([true,false]),
            'deletable' => $this->faker->randomElement([1,0]),
            'todo_id' => $todo->id,
            'user_id' => $user->id,
        ];
    }
}
