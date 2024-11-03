<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['trainee_id', 'event_id'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function orderEvent()
    {
        return $this->hasOne(OrderEvent::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
