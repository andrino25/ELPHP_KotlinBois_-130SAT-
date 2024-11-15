<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spider extends Model
{
    use HasFactory;

    protected $primaryKey = 'spiderID';

    protected $fillable = [
        'userID',
        'spiderName',
        'spiderSize',
        'spiderHealthStatus',
        'spiderCostPrice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }
}
