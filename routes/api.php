<?php

use App\Http\Controllers\Api\v1\FormatterController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function () {
    Route::post('formatter', [FormatterController::class, 'formatJson'])->middleware('ipCheck')->name('api.v1.formatter');
});
