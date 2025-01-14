<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppsCountry extends Model
{
    use HasFactory;
    protected $table = 'apps_countries';
    protected $fillable = ['country_code', 'country_name'];
}
