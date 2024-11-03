<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['payable_id', 'payable_type', 'trainee_id', 'payment_method_id', 'total_amount', 'transaction_date', 'status'];

    public function payable()
    {
        return $this->morphTo();
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }    

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function orderEvent()
    {
        return $this->belongsTo(OrderEvent::class);
    }

    public function orderPost()
    {
        return $this->belongsTo(OrderPost::class);
    }

    public function getTraineeNameAttribute()
    {
        if ($this->payable instanceof \App\Models\OrderPost) {
            return $this->payable->trainee->name;
        } elseif ($this->payable instanceof \App\Models\OrderEvent) {
            return $this->payable->participant->trainee->name;
        }
        return null;
    }
}
