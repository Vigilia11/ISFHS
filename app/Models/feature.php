<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feature extends Model
{
    use HasFactory;

    protected $fillable =[
        'facility_id',
        'feature'   
    ];

    public function facility(): BelongsTo{
        return $this->belongsTo(facility::class, 'id', 'facility_id');
    }
}
