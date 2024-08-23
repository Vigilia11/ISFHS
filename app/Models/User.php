<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(account::class,'id', 'user_id');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(profile::class,'id', 'user_id');
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(rate::class,'id', 'user_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(comment::class,'id', 'user_id');
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(reply::class,'id', 'user_id');
    }
}
