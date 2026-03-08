<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Review;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
        'role', 'phone', 'address', 'avatar', 'is_suspended',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'is_suspended' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
