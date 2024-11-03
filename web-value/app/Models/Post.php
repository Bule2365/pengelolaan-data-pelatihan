<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['trainer_id', 'data_price_id', 'description', 'image', 'schedule_id', 'categories_post_id','post_date', 'status'];

    protected $dates = ['post_date'];

    public function isRegisteredBy(int $traineeId): bool
    {
        return $this->trainings()->where('trainee_id', $traineeId)->exists();
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function dataPrice()
    {
        return $this->belongsTo(DataPrice::class);
    }

    public function scheduleTraining()
    {
        return $this->belongsTo(ScheduleTraining::class, 'schedule_id');
    }

    public function schedule()
    {
        return $this->belongsTo(ScheduleTraining::class);
    }

    public function categoriesPost()
    {
        return $this->belongsTo(CategoriesPost::class);
    }

    public function feedbackTrainings()
    {
        return $this->hasMany(FeedbackTraining::class);
    }
}
