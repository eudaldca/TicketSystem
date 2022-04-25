<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends Factory
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $ticket_id = $this->faker->randomElement(Db::table('tickets')->pluck('id'));
        $ticket = Ticket::find($ticket_id);
        $users[] = $ticket->issuer->id;
        if (isset($ticket->assignee)) {
            $users[] = $ticket->assignee->id;
        }
        return [
            'content' => $this->faker->realText(),
            'action' => $this->faker->boolean(20) ? $this->faker->numberBetween(0, 1) : null,
            'ticket_id' => $ticket_id,
            'user_id' => $this->faker->randomElement($users),
        ];
    }
}
