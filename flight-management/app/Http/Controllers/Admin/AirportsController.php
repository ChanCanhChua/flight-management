<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\City;
use App\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class AirportsController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        if (request()->ajax()) {
            $airports = Airport::join('cities', 'airports.city_id', '=', 'cities.id')->select('airports.*', 'cities.name as city')->orderBy('airports.created_at', 'desc');
            return DataTables::of($airports)->editColumn('city', function($airport)
            {
                return $airport->city;
            })->make(true);
        }

        return view('admin.pages.list-airport',['cities' => City::all(), 'pageName' => 'Danh sách sân bay']);
    }
    public function create()
    {
        try{
            $validator = Validator::make(request()->all(),[
                'name' => 'required',
                'city_id' => 'required|exists:cities,id',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $airport = Airport::create(request()->all());
            if($airport){
                DB::commit();


                return $this->successResponse(null,'Created Successfully');
            }
            return $this->errorResponse();

        }catch (\Exception $exception){
            dd($exception->getMessage());
            DB::rollBack();
            Log::info($exception->getMessage());
        }
    }

    public function update()
    {
        try{
            $validator = Validator::make(request()->all(),[
                'airport_id' => 'required|exists:airports,id',
                'name' => 'required',
                'city_id' => 'required|exists:cities,id',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $airport = Airport::find(request()->airport_id);
            if($airport){
                $airport->name = request()->name;
                $airport->city_id = request()->city_id;
                $airport->save();
                DB::commit();
                return $this->successResponse(null,'Created Successfully');
            }
            return $this->errorResponse();

        }catch (\Exception $exception){
            dd($exception->getMessage());
            DB::rollBack();
            Log::info($exception->getMessage());
        }
    }

    public function delete()
{
    try {
      
        $validator = Validator::make(request()->all(), [
            'airport_id' => 'required|exists:airports,id',
        ]);

        if ($validator->fails()) {
            Log::info('Validation failed: ', $validator->errors()->toArray());
            return $this->errorResponse('Delete failed', $validator->errors()->all());
        }

        DB::beginTransaction();

       
        $airport = Airport::find(request()->airport_id);

        if (!$airport) {
            DB::rollBack();
            Log::warning('Airport not found: ', ['airport_id' => request()->airport_id]);
            return $this->errorResponse('Airport not found');
        }

       
        Log::info('Deleting airport: ', ['airport_id' => $airport->id]);

        
        $airport->delete();
        DB::commit();

        Log::info('Airport deleted successfully: ', ['airport_id' => $airport->id]);
        return $this->successResponse(null, 'Deleted Successfully');
    } catch (\Exception $exception) {
     
        DB::rollBack();
        Log::error('Error deleting airport: ' . $exception->getMessage(), [
            'trace' => $exception->getTraceAsString(),
            'request' => request()->all(),
        ]);

        
        return $this->errorResponse('An error occurred while deleting the airport');
    }
}


}

