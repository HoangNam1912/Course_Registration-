<?php

namespace App\Http\Controllers;

use App\Models\AppsCountry;
use App\Repositories\CountryRepositoryInterface;
use Illuminate\Http\Request;

class AppsCountryController extends Controller
{

    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    // Lấy tất cả các quốc gia không có phân trang
    public function getAllCountries()
    {
        //Query Builder
        $countries = AppsCountry::all(); 

        return view('country.home', compact('countries'));
    }

    // Lấy tất cả các quốc gia có phân trang
    public function getAllCountriesPaginated()
    {
        // Pagination
        $countries = AppsCountry::paginate(10); 

    return view('country.home1', compact('countries'));
    }

    public function showSearchByIdForm()
    {
        return view('country.search-by-id');
    }

    // Lấy quốc gia theo ID
    public function getCountryById($id)
    {
      

        try {
            $country = AppsCountry::findOrFail($id);
    
            return response()->json([
                'code' => 200,
                'error' => null,
                'data' => $country,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
            return response()->json([
                'code' => 404,
                'error' => 'Duong dan khong hop le ',
                'data' => null,
            ], 404);
        }
        

    }
    

    // Lấy quốc gia theo mã quốc gia
    public function getCountryByCode($code)
    {
    try {
        $country = AppsCountry::where('country_code', $code)->firstOrFail();

        return response()->json([
            'code' => 200,
            'error' => null,
            'data' => $country,
        ]);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
        return response()->json([
            'code' => 404,
            'error' => 'Duong dan khong hop le ',
            'data' => null,
        ], 404);
    }
    }
   

}
