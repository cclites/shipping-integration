<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'api'], function()
{
    Route::post('shipstation/notify-shipped', 'ShipStationController@notifyShipped');
    Route::get('shipstation/notify-shipped', 'ShipStationController@testConnection');

});

/***************************************************************************
 * DIAGNOSTIC REPORTS - unused
 ***************************************************************************/
//Route::post('api/shipstation/report', 'ShipStationController@report');
//Route::post('api/controlpad/report', 'ControlPadController@report');

