<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTraining extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function dataPrices()
    {
        return $this->hasMany(DataPrice::class);
    }
}
