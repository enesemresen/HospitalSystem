<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'first_name', 
        'last_name', 
        'phone', 
        'email', 
        'adress', 
        'role',
    ];

    public function userIdentity(): HasOne
    {
        return $this->hasOne(UserIdentity::class);
    }

    public function polyclinics(): HasMany
    {
        return $this->hasMany(Polyclinic::class, 'personal_id');
    }

    public function analysesCreated(): HasMany
    {
        return $this->hasMany(Analyse::class, 'created_id');
    }

    public function analysesPatient(): HasMany
    {
        return $this->hasMany(Analyse::class, 'patient_id');
    }

    public function analysesPersonal(): HasMany
    {
        return $this->hasMany(Analyse::class, 'personal_id');
    }

    public function appointmentsPatient(): HasMany
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }

    public function appointmentsPersonal(): HasMany
    {
        return $this->hasMany(Appointment::class, 'personal_id');
    }

    public function scopeGetDoctors($query)
    {
        return $query->where('role', 'doctor');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
