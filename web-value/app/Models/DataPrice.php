<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPrice extends Model
{
    use HasFactory;

    protected $fillable = ['training_title', 'price', 'type_training_id', 'trainer_id'];

    public function typeTraining()
    {
        return $this->belongsTo(TypeTraining::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }

    public function trainingMaterials()
    {
        return $this->hasMany(TrainingMaterial::class);
    }

    public function scheduleTrainings()
    {
        return $this->hasMany(ScheduleTraining::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
