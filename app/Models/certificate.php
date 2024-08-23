<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'picture',
        'name',
    ];

    public function facility(): BelongsTo
    {
        return $this->belongsTo(facility::class, 'facility_id', 'id');
    }
}
