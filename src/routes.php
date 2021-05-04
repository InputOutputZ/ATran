<?php

Route::post('detecttext', '\ATran\Translate\PlayWithAPIController@detectText');
Route::post('transliteratetext', '\ATran\Translate\PlayWithAPIController@transliterateText');
Route::post('translatetext', '\ATran\Translate\PlayWithAPIController@translateText');
Route::get('transliterationavailable', '\ATran\Translate\PlayWithAPIController@transliterationsAvailable');
Route::get('translationavailable', '\ATran\Translate\PlayWithAPIController@translationAvailable');
