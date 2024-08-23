<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'front_id',
        'back_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function facility():BelongsTo
    {
        return $this->belongsTo(facility::class, 'id', 'account_id');
    }
}
