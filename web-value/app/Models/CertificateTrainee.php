<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateTrainee extends Model
{
    use HasFactory;

    protected $fillable = ['issue_date', 'trainee_id', 'certificate_image'];

    public function trainee()
    {
        return $this->belongsTo(Trainee::class);
    }
}
