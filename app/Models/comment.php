<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable =[
        'facility_id',
        'user_id',
        'comment'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function facility(): BelongsTo
    {
        return $this->belongsTo(facility::class, 'facility_id', 'id');
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(reply::class, 'id', 'comment_id');
    }
}
