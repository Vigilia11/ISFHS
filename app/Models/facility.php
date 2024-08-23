<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facility extends Model
{
    use HasFactory;

    protected $fillable =[
        'account_id',
        'type',
        'name',
        'status',
        'street',
        'barangay',
        'city',
        'province',
        'facility_picture',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(account::class, 'account_id', 'id');
    }

    public function feature(): BelongsTo
    {
        return $this->belongsTo(feature::class, 'id', 'facility_id');
    }

    public function certificate(): HasMany
    {
        return $this->hasMany(certificate::class);
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(rate::class,'id', 'user_id');
    }

    public function comment(): BelongsTo
    {
        return $thiis->belongsTo(comment::class, 'id', 'facility_id');
    }
}
