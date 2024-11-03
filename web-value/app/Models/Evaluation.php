<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'trainee_id'];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function evaluationResponses()
    {
        return $this->hasMany(EvaluationResponse::class);
    }
}
