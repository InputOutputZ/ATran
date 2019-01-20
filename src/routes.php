<?php

Route::post('detecttext', 'AzureTranController@detectText');
Route::post('transliteratetext', 'AzureTranController@transliterateText');
Route::post('translatetext', 'AzureTranController@translateText');
Route::get('transliterationavailable', 'AzureTranController@transliterationsAvailable');
Route::get('translationavailable', 'AzureTranController@translationAvailable');
