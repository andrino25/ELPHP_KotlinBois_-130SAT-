<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'spider_id',
        'notifName',
        'notifContent',
        'notifType',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function spider()
    {
        return $this->belongsTo(Spider::class);
    }
}
