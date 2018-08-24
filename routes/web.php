<?php

Route::get('/', function () {
    return view('landing');
});

Auth::routes();



Route::get('/play-video1', 'ScreenDisplayController@playvideo1');
Route::get('/play-video2', 'ScreenDisplayController@playvideo2');
Route::get('/play-video3', 'ScreenDisplayController@playvideo3');

Route::get('/watch/{feedname}', 'StreamController@watchFeed');
Route::get('/resolve-url/{url}', 'ScreenDisplayController@resolveUrl');

Route::middleware(['auth'])->group(function () {
    Route::get('/control-panel', 'ControlPanelController@index');
    Route::post('/play-item', 'StreamController@playItem');
});
