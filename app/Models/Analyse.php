<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Analyse extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'type', 
        'result',
        'created_id',
        'patient_id',
        'personal_id',        
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_id');
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function personal(): BelongsTo
    {
        return $this->belongsTo(User::class, 'personal_id');
    }

}
