<?php

Route::group(array('prefix' => Config::get('opencloud::route_prefix')), function() {
    Route::get('/', 'Unm\Laravel\OpenCloud\OpenCloudController@index');
});