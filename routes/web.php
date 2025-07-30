<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('countries.index');
});

// Resource controller using string syntax (Laravel 5.4 way)
Route::resource('countries', 'CountryController');

// Extra routes if needed
Route::get('/update-third-country', function () {
    $country = \App\Country::orderBy('population', 'desc')
        ->orderBy('name', 'asc')
        ->skip(2)
        ->first();

    if ($country) {
        $country->population = ceil($country->population / 1000000) * 1000000;
        $country->save();
        return "Updated {$country->name} to " . number_format($country->population);
    }

    return 'No third country found.';
});

Route::get('/delete-uk', function () {
    $deleted = \App\Country::where('name', 'United Kingdom')->delete();

    return $deleted ? "United Kingdom deleted." : "United Kingdom not found.";
});
Route::get('/countries/search', 'CountryController@search')->name('countries.search');