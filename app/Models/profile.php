<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'first_name',
        'last_name',
        'sex',
        'birthdate',
        'mobile_number',
        'barangay',
        'city',
        'municipality',
        'province',
        'picture',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
