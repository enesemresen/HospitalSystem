<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'adress',
    ];

    public function polyclinics(): HasMany
    {
        return $this->hasMany(Polyclinic::class);
    }
}
