<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\Log;
use App\Models\User;

class LogSuccessfulLogout
{
    public function handle(Logout $event)
    {
        $user = $event->user;

        // Cek apakah user adalah instance dari User (bukan Trainer atau Trainee)
        if ($user instanceof User) {
            Log::create([
                'name' => $user->username,
                'roles' => 'admin', // Hanya mencatat role 'users'
                'action' => 'logout',
                'details' => 'User logged out',
            ]);
        }
    }
}
