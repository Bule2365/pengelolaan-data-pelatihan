<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Trainee extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'email', 'name', 'personal_phone', 'company', 
        'company_phone', 'company_address', 'job_title', 
        'gender', 'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function orderPosts()
    {
        return $this->hasOne(OrderPost::class);
    }

    public function orderEvents()
    {
        return $this->hasOne(OrderEvent::class);
    }

    public function certificates()
    {
        return $this->hasMany(CertificateTrainee::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function feedbackTrainings()
    {
        return $this->hasMany(FeedbackTraining::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }
}
