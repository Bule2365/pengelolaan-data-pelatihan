<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TrainerNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $trainer;
    public $schedule;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trainer, $schedule)
    {
        $this->trainer = $trainer;
        $this->schedule = $schedule;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Akun dan Jadwal Pelatihan Anda')
                    ->markdown('emails.trainer_notification');
    }
}
