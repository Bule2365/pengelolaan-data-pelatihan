<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'location'];

    public function schedules()
    {
        return $this->hasMany(ScheduleTraining::class);
    }

    public function event()
    {
        return $this->hasMany(Event::class);
    }
}
