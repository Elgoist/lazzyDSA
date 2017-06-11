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
    return view('home');
});

Route::get('/characters', 'CharacterViewController@index');

Route::get('/character/{character}', 'CharacterViewController@single');

Route::get('/character/{character}/diary', 'CharacterViewController@diary');