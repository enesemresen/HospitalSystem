<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserIdentity extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'tc_no', 
        'mother_name', 
        'father_name', 
        'serial_no', 
        'birthday', 
        'birthplace',
        'user_id',
        'insurance_number',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}



