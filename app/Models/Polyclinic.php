<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Polyclinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'name',
        'personal_id',
        'hospital_id',
    ];

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }

    public function personal(): BelongsTo
    {
        return $this->belongsTo(User::class, 'personal_id');
    }

}
