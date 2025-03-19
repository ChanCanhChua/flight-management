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
            $tickets = Ticket::join('flight_time', 'flight_time.id', '=', 'ticket.flight_time_id')
                ->join('passenger', 'passenger.id', '=', 'ticket.passenger_id')
                ->select('ticket.*', 
                    'flight_time.flight_code as flight_code',
                    'flight_time.flight_time as flight_time',
                    'passenger.passenger_name as passenger_name',
                    'passenger.passenger_tel as passenger_tel',
                    'passenger.passenger_email as passenger_email',
                )
                ->orderBy('ticket.created_at', 'desc');
            return DataTables::of($tickets)
                ->editColumn('flight_time', function($tickets){
                    return $tickets->flight_time;
                })
                ->editColumn('passenger_name', function($tickets){
                    return $tickets->passenger_name;
                })
                ->editColumn('passenger_tel', function($tickets){
                    return $tickets->passenger_tel;
                })
                ->editColumn('passenger_email', function($tickets){
                    return $tickets->passenger_email;
                })
                ->editColumn('flight_date_time', function($tickets){
                    return $tickets->flight_date.' '.$tickets->flight_time;
                })->filterColumn('passenger_email', function ($query, $keyword) {
                    $query->where('passenger.passenger_email', 'LIKE', '%' . $keyword . '%');
                })
                ->filterColumn('passenger_name', function ($query, $keyword) {
                    $query->where('passenger.passenger_name', 'LIKE', '%' . $keyword . '%');
                })
                ->make(true);
        }

        return view('admin.pages.ticket',['airports' => Airport::all(), 'pageName' => 'Danh sách đặt vé']);
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
