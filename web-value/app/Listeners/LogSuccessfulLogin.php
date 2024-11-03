<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\Log;
use App\Models\User;

class LogSuccessfulLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;

        // Cek apakah user adalah instance dari User (bukan Trainer atau Trainee)
        if ($user instanceof User) {
            Log::create([
                'name' => $user->username,
                'roles' => 'admin', // Hanya mencatat role 'users'
                'action' => 'login',
                'details' => 'User logged in',
            ]);
        }
    }
}
