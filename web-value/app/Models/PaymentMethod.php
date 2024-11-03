<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    protected $fillable = [
        'method_name',
        'no',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }    

    public function orderEvents()
    {
        return $this->hasMany(OrderEvent::class);
    }

    public function orderPosts()
    {
        return $this->hasMany(OrderPost::class);
    }
}
