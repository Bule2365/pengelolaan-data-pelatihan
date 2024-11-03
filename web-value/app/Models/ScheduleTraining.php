<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleTraining extends Model
{
    use HasFactory;

    protected $fillable = ['data_price_id', 'trainer_id', 'participant_count', 'training_material_id', 'schedule_date', 'hotel_id'];

    public function dataPrice()
    {
        return $this->belongsTo(DataPrice::class);
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }   

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainingMaterial()
    {
        return $this->belongsTo(TrainingMaterial::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function training()
    {
        return $this->hasMany(Training::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'schedule_id');
    }
}
