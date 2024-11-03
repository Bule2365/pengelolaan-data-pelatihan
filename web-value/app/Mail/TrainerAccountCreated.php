<?php

namespace App\Mail;

use App\Models\Trainer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrainerAccountCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $trainer;
    public $password;

    public function __construct(Trainer $trainer, $password)
    {
        $this->trainer = $trainer;
        $this->password = $password;
    }

    public function build()
    {
        return $this->markdown('emails.trainers.account-created')
            ->subject('Akun Pelatih Anda Telah Dibuat');
    }
}
