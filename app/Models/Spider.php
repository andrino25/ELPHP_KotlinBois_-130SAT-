<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spider extends Model
{
    use HasFactory;

    protected $primaryKey = 'spiderId';

    protected $fillable = [
        'userId',
        'spiderName',
        'spiderImageRef',
        'spiderSize',
        'spiderEstimatedMarketValue',
        'spiderHealthStatus',
        'spiderDescription',
        'spiderIsFavorite'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
