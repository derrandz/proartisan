<?php


/*
 |------------------------------------------------------------
 |
 |  				  ProArtisan Routes.
 |
 |------------------------------------------------------------
 */

Route::GET('/proartisan/insert_commands', ['as' => 'proartisan.insert', 'uses' => 'Hamzaouaghad\Proartisan\ProArtisanController@InsertCommands']);

//To avoid timing out when running slow commands, we avoided to use POST.
Route::GET('/proartisan/execute_commands', ['as' => 'proartisan.exec', 'uses' => 'Hamzaouaghad\Proartisan\ProArtisanController@ExecuteCommands']);
