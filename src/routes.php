<?php

Route::post('detecttext', '\AzureTran\Translate\PlayWithAPIController@detectText');
Route::post('transliteratetext', '\AzureTran\Translate\PlayWithAPIController@transliterateText');
Route::post('translatetext', '\AzureTran\Translate\PlayWithAPIController@translateText');
Route::get('transliterationavailable', '\AzureTran\Translate\PlayWithAPIController@transliterationsAvailable');
Route::get('translationavailable', '\AzureTran\Translate\PlayWithAPIController@translationAvailable');
