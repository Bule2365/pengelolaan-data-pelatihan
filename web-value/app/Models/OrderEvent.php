<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'trainee_id',
        'participant_id',
        'payment_method_id',
        'total_amount',
        'status',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }    

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    // Pada model OrderEvent
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
