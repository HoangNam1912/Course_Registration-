<?php

namespace App\Repositories;

use App\Models\AppsCountry;

class CountryRepository implements CountryRepositoryInterface

{
    public function create(array $data)
    {
        return AppsCountry::create($data);
    }

    public function update($id, array $data)
    {
        $country = AppsCountry::find($id);
        $country->update($data);
        return $country;
    }

    public function delete($id)
    {
        $country = AppsCountry::find($id);
        $country->delete();
        return $country;
    }
}