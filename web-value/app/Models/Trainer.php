<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Trainer extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = ['name', 'phone', 'biography', 'experience', 'password'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function trainingMaterials()
    {
        return $this->hasMany(TrainingMaterial::class);
    }

    public function scheduleTrainings()
    {
        return $this->hasMany(ScheduleTraining::class);
    }    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function schedules()
    {
        return $this->hasMany(ScheduleTraining::class);
    }

    public function dataPrices()
    {
        return $this->hasMany(DataPrice::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
