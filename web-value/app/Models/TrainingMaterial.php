<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingMaterial extends Model
{
    use HasFactory;

    protected $fillable = ['data_price_id', 'trainer_id', 'material_file'];

    public function dataPrice()
    {
        return $this->belongsTo(DataPrice::class);
    }

    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }
}
