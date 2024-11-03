<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'trainee_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }

    public function ScheduleTraining()
    {
        return $this->belongsTo(ScheduleTraining::class, 'schedule_id');
    }

    public static function isRegistered(int $traineeId, int $postId): bool
    {
        return self::where('trainee_id', $traineeId)
                   ->where('post_id', $postId)
                   ->exists();
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class, 'training_id');
    }
}
