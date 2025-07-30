<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Allow mass assignment on these fields
    protected $fillable = ['name', 'population'];
}
