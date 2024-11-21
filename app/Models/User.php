<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Spider;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $fillable = [
        'email',
        'password',
        'userFirstName',
        'userMiddleName',
        'userLastName',
        'userAddress',
        'userProfilePicRef'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function spiders()
    {
        return $this->hasMany(Spider::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
