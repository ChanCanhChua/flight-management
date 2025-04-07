<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\City;
use App\Models\FlightTime;
use App\Models\Ticket;
use App\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        if (request()->ajax()) {
            $flights = Flight::join('flight_time', 'flight_time.flight_id', '=', 'flights.id')
                ->join('airports as origin_ap', 'origin_ap.id', '=', 'flights.origin_ap_id')
                ->join('airports as destination_ap', 'destination_ap.id', '=', 'flights.destination_ap_id')
                ->select('flights.*', 'flight_time.flight_time as flight_time','origin_ap.name as origin_ap_name','destination_ap.name as destination_ap_name')
                ->orderBy('flights.created_at', 'desc');
            if(request()->get('origin_ap_id')){
                $flights->where('origin_ap.id',request()->get('origin_ap_id'));
            }
            if(request()->get('destination_ap_id')){
                $flights->where('destination_ap.id',request()->get('destination_ap_id'));
            }
            return DataTables::of($flights)
                ->editColumn('origin_ap_name', function($flight){
                    return $flight->origin_ap_name;
                })
                ->editColumn('destination_ap_name', function($flight){
                    return $flight->destination_ap_name;
                })
                ->editColumn('flight_time', function($flight){
                    return $flight->flight_time;
                })
                ->filterColumn('origin_ap_name', function ($query, $keyword) {
                    $query->where('origin_ap.name', 'LIKE', '%' . $keyword . '%');
                })
                ->filterColumn('destination_ap_name', function ($query, $keyword) {
                    $query->where('destination_ap.name', 'LIKE', '%' . $keyword . '%');
                })
                ->make(true);
        }

        return view('admin.pages.list-flight',['airports' => Airport::all(), 'pageName' => 'Danh sách chuyến bay']);
    }

    public function createView(){
        return view('admin.pages.create-ticket',['airports' => Airport::all(), 'pageName' => 'Tạo vé chuyến bay']);

    }

    public function create()
    {
        try{
            $validator = Validator::make(request()->all(),[
                'origin_ap_id' => 'required|exists:airports,id',
                'destination_ap_id' => 'required|exists:airports,id',
                'price' => 'required',
                'total_seat' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $flight =  Flight::create(request()->all());
            if($flight){
                $data = request()->all();
                $data['flight_time'] = $data['flight_time'].':00';
                $flight->flightTimes()->create($data);
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
                'origin_ap_id' => 'required|exists:airports,id',
                'destination_ap_id' => 'required|exists:airports,id',
                'price' => 'required',
                'total_seat' => 'required',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $flight = Flight::find(request()->flight_id);
            if($flight){
                $flight->origin_ap_id = request()->origin_ap_id;
                $flight->destination_ap_id = request()->destination_ap_id;
                $flight->price = request()->price;
                $flight->total_seat = request()->total_seat;
                $flight->flightTimes()->update([
                    'flight_time' => request()->flight_time
                ]);
                $flight->save();
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
        try{
            $validator = Validator::make(request()->all(),[
                'flight_id' => 'required|exists:flights,id',
            ]);
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $flight = Flight::find(request()->flight_id);
            if($flight){
                $flight->delete();

                return $this->successResponse(null,'Created Successfully');
            }
            return $this->errorResponse();

        }catch (\Exception $exception){
            dd($exception->getMessage());
            DB::rollBack();
            Log::info($exception->getMessage());
        }
    }


}
