<?php

Route::group(['middleware' => 'web', 'prefix' => 'bcrud', 'namespace' => 'Modules\Bcrud\Http\Controllers'], function()
{
    Route::get('/', 'BcrudController@index');
});
