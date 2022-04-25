<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = Db::table('users')->pluck('id');
        $categories = Db::table('categories')->pluck('id');
        return [
            'title' => $this->faker->realText(50),
            'description' => $this->faker->realText(500),
            'priority' => $this->faker->numberBetween(0, 2),
            'status' => $this->faker->numberBetween(0, 1),
            'assignee_id' => $this->faker->boolean(70) ? $this->faker->randomElement($users) : null,
            'issuer_id' => $this->faker->randomElement($users),
            'category_id' => $this->faker->boolean(20) ? $this->faker->randomElement($categories) : null,
        ];
    }
}
