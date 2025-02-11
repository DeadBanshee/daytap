<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\daytapcontroller;


//Route::get('/welcome', [daytapcontroller::class, 'welcome'])->name('welcome');

Route::get('/', function() { 
    return view('welcome'); });


Route::get('/welcome', [daytapcontroller::class, 'welcome'])->name('welcome');

Route::get('/createAccount', [daytapcontroller::class, 'createAccount'])->name('createAccount');

Route::post('/storeNewAccount', [daytapcontroller::class, 'storeNewAccount'])->name('storeNewAccount');

Route::post('/login', [daytapcontroller::class, 'login'])->name('login');

Route::post('/logout', [daytapcontroller::class, 'logout'])->name('logout');

Route::post('/likeUser', [daytapcontroller::class, 'likeUser'])->name('likeUser');

Route::post('/dislikeUser', [daytapcontroller::class, 'dislikeUser'])->name('dislikeUser');

Route::get('/homepage', [daytapcontroller::class, 'homepage'])->name('homepage');

Route::get('/messages', [daytapcontroller::class, 'messages'])->name('messages');

Route::post('/openChat', [daytapcontroller::class, 'openChat'])->name('openChat');