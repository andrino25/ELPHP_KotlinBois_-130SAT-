<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spider extends Model
{
    use HasFactory;

    protected $fillable = [
        'spiderSpecies',
        'spiderHealthStatus',
        'spiderBuyCost',
        'spiderSellPrice',
        'spiderQuantity',
        'spiderImageRef'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
