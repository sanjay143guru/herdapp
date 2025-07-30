<?php

use Illuminate\Support\Facades\Route;
use App\Country; // For Laravel 5.4, models usually in App namespace

Route::get('/', function () {
    return redirect()->route('countries.index');
});

// Laravel 5.4 resource route syntax
Route::resource('countries', 'CountryController');

Route::get('/update-third-country', function () {
    $country = Country::orderBy('population', 'desc')
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
    $deleted = Country::where('name', 'United Kingdom')->delete();

    if ($deleted) {
        return "United Kingdom deleted.";
    } else {
        return "United Kingdom not found.";
    }
});

Route::get('/test-route', function () {
    return 'Test route works!';
})->name('test.route');

Route::get('/test-route2', function () {
    return 'Test route 2 works!';
})->name('test.route2');
