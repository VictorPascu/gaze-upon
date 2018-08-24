<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    //return (int) $user->id === (int) $id;
    return true;
});

Broadcast::channel('global-screens.{feedname}', function ($feedname) {
    return true;
});

Broadcast::channel('presence-global-screens', function () {
    return true;
});
