<?php

Route::get('/', function () {
    return view('landing');
});

Auth::routes();

Route::get('/play-video1', 'StreamController@playPresetVideo1');
Route::get('/play-video2', 'StreamController@playPresetVideo2');
Route::get('/play-video3', 'StreamController@playPresetVideo3');

Route::get('/watch/{feedname}', 'StreamController@watchFeed');
Route::get('/resolve-url/{url}', 'ScreenDisplayController@resolveUrl');

Route::middleware(['auth'])->group(function () {
    Route::get('/control-panel', 'ControlPanelController@index');
    Route::post('/play-item', 'StreamController@playItem');
});
