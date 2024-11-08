<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluationItem extends Model
{
    use HasFactory;

    protected $fillable = ['section', 'question'];

    public function evaluationResponses()
    {
        return $this->hasMany(EvaluationResponse::class);
    }
}
