<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_title', 
        'event_description', 
        'event_time',
        'price',  // Tambahkan 'price'
        'trainer_id', 
        'event_type',
        'image',  // Tambahkan 'image'
        'hotel_id',
    ];    

    protected $dates = [
        'event_time',  
    ];    

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function eventParticipant()
    {
        return $this->hasOne(EventParticipant::class, 'event_id');
    }
}
