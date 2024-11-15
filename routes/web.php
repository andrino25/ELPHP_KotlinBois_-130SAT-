<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpiderController;

Route::get('/', function () {
    return view('welcome');
});
