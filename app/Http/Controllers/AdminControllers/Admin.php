<?php


namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppsCountry;
use App\Repositories\CountryRepositoryInterface;
use League\Config\Configuration;
use Illuminate\Database\Eloquent\ModelNotFoundException;

 
class Admin extends Controller
{

    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }
    public function index ()
    {
        return view('admin.index');
    }
    public function getAllCountries()
    {
        return view('admin.country');
    }
    // Tạo quốc gia mới
    public function createCountry(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'country_code' => 'required|max:3',
                'country_name' => 'required'
            ]);

            $newCountry = AppsCountry::create($validatedData);

            return response('api/admin/country')->json([
                'code' => 201,
                'error' => null,
                'data' => $newCountry,
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => 400,
                'error' => 'Đã xảy ra lỗi trong quá trình thêm quốc gia',
                'data' => null,
            ], 400);
        }
    }
    public function createCountryView()
    {
        return view('admin.create');
    }

    // Chỉnh sửa quốc gia
    public function updateCountry(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'country_code' => 'required|max:3',
                'country_name' => 'required'
            ]);

            $country = AppsCountry::findOrFail($id);
            $country->update($validatedData);

            return response()->json([
                'code' => 200,
                'error' => null,
                'data' => $country,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => 404,
                'error' => 'Quốc gia không tồn tại',
                'data' => null,
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => 400,
                'error' => 'Đã xảy ra lỗi trong quá trình cập nhật quốc gia',
                'data' => null,
            ], 400);
        }
    }
    public function editCountryView($id)
    {
        try {
            $country = AppsCountry::findOrFail($id);
            return view('admin.edit', compact('country'));
        } catch (ModelNotFoundException $exception) {
            return redirect('/admin/countries')->with('error', 'Quốc gia không tồn tại');
        }
    }

    // Xóa quốc gia
    public function deleteCountry($id)
    {
        try {
            $country = AppsCountry::findOrFail($id);
            $country->delete();

            return response()->json([
                'code' => 200,
                'error' => null,
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'code' => 404,
                'error' => 'Quốc gia không tồn tại',
                'data' => null,
            ], 404);
        } catch (\Exception $exception) {
            return response()->json([
                'code' => 400,
                'error' => 'Đã xảy ra lỗi trong quá trình xóa quốc gia',
                'data' => null,
            ], 400);
        }
    }
    
}


