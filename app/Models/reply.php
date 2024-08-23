<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reply extends Model
{
    use HasFactory;

    protected $fillable =[
        'comment_id',
        'user_id',
        'reply',
    ];

    public function comment(): BelongsTo
    {
        return $this->belongsTo(comment::class, 'comment_id', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
