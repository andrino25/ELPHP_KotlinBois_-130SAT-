<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $primaryKey = 'catalogId';

    protected $fillable = [
        'catalogName',
        'catalogDescription',
        'catalogImageRef'
    ];

    public $timestamps = false;
}
