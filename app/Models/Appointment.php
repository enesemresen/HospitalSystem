<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'date', 
        'time', 
        'status',
        'personal_id',
        'patient_id',
    ];

    public function barcode():HasMany
    {
        return $this->hasMany(Barcode::class);
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
