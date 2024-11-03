<?php

namespace App\Listeners;

use App\Events\TraineeRegisteredForEvent;
use App\Models\Participant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddParticipantToEvent implements ShouldQueue
{
    use InteractsWithQueue;

    // public function handle(TraineeRegisteredForEvent $event)
    // {
    //     Participant::create([
    //         'trainee_id' => $event->traineeId,
    //         'event_id' => $event->eventId,
    //     ]);
    // }
}
