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

Auth::routes();

Route::get('/', function () {
    return view('landing');
});

Route::get('/watch/{feedname}', 'StreamController@watchFeed');

Route::get('/play-video1', 'ScreenDisplayController@playvideo1');
Route::get('/play-video2', 'ScreenDisplayController@playvideo2');
Route::get('/play-video3', 'ScreenDisplayController@playvideo3');

Route::get('/resolve-url/{url}', 'ScreenDisplayController@resolveUrl');

Route::middleware(['auth'])->group(function () {
    Route::get('/control-panel', 'ControlPanelController@index');
    Route::post('/play-item', 'StreamController@playItem');
});





