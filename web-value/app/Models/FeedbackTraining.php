<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackTraining extends Model
{
    use HasFactory;

    protected $fillable = ['trainee_id', 'post_id', 'trainer_id', 'description', 'score'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
