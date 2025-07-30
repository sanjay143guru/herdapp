<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('countries.index');
});

// Resource controller (Laravel 5.4 string syntax)
Route::resource('countries', 'CountryController');

// Custom routes pointing to controller methods
Route::get('/update-third-country', 'CountryController@updateThirdCountryPopulation')->name('countries.updateThird');

Route::get('/delete-uk', 'CountryController@deleteUnitedKingdom')->name('countries.deleteUk');

Route::get('/countries/search', 'CountryController@search')->name('countries.search');
