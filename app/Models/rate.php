<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'user_id',
        'rate'
    ];

    public function facility():BelongsTo
    {
        return $this->belongsTo(facility::class, 'facility_id', 'id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
