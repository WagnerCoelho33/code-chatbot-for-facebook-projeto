<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $text = (new \CodeBot\Message\Text(1))->message('Hello');
    dd($text);
    return view('welcome');
});

Route::prefix('bot')
    ->group(function(){
        Route::get('/webhook', 'BotController@subscribe');
        Route::post('/webhook', 'BotController@receiveMessage');
    });
