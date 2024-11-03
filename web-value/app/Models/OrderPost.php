<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPost extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'trainee_id',
        'training_id',
        'payment_method_id',
        'total_amount',
        'status',
    ];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }    

    public function dataPrice()
    {
        return $this->hasOne(DataPrice::class);
    }
    
    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }    

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }
}
