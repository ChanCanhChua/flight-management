<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\FlightTime;
use App\Models\Passenger;
use App\Models\Ticket;
use App\ResponseTrait;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $filters = request()->all();
        $flightDate = Carbon::parse($filters['flight_time']);
        $today = Carbon::today();
        if ($flightDate->lt($today)) {
            return redirect('/Home'); 
        }
        $airports = Airport::with('city')->get();
        $validator = Validator::make(request()->all(),[
            'origin_ap' => 'required|exists:airports,id',
            'destination_ap' => 'required|exists:airports,id',
        ]);

        $filters['quantity'] = $filters['quantity'] ?? 1;
        $flight_list = FlightTime::with('flight','flight.originAirport','flight.destinationAirport','tickets')
        ->whereHas('flight', function ($q) use($filters){
                $q->where([
                ['origin_ap_id', '=',$filters['origin_ap']],
                ['destination_ap_id', '=',  $filters['destination_ap']]
                ]);
        })->withCount(['tickets as ticket_booked'=> function ($q) use($filters){
            $q->select(DB::raw("SUM(quantity) as quantity_booked"))->whereDate('flight_date', $filters['flight_time']);
        }])->get();

        $flight_list = collect($flight_list)->filter(function ($flight) use ($filters) {
            $quantity_booked = $flight->ticket_booked ?? 0;
            $remaining_seats = $flight->flight->total_seat - $quantity_booked;
            $flight->remaining_seats = $remaining_seats;
            return Carbon::parse($filters['flight_time'].' '.$flight->flight_time)->gte(Carbon::now());
        })->values();

        if ($validator->fails()) {
            return $this->errorResponse('List fail',$validator->errors()->all());
        }
        $data =  [
            'origin_aps' => $airports,
            'destination_aps' => $airports,
            'flight_list' => $flight_list,
            'current_flight_time' => $filters['flight_time']
        ];
        if(request()->ajax()){
            return response()->json([
                'flightData' => view('client.partials.booking.flight-list',$data)->render()
            ]);
        }
        $data['currentOriginAP'] = $filters['origin_ap'];
        $data['currentDestinationAP'] = $filters['destination_ap'];
        $data['quantity'] = $filters['quantity'];

        return view('client.pages.booking',$data);
    }
    public function store()
    {
       try {
            $params = request()->all();
            $params['tickets'] = json_decode($params['tickets'] ?? '[]', true);
            $validator = Validator::make($params, [
                'passenger_name' => 'required|max:255',
                'passenger_tel' => 'required|regex:/^\+?[0-9]{10,15}$/',
                'passenger_email' => 'required|email',
                // 'passenger_id' =>'required|regex:/^\d+$/',
                'tickets.*.flight_time_id' => 'required|exists:flight_time,id',
                'tickets.*.amount_booked' => 'required|regex:/^[1-9][0-9]*$/',
                'tickets.*.quantity' => 'required|regex:/^[1-9][0-9]*$/',
                'flight_date' => 'required'
            ]);
            
            if ($validator->fails()) {
                return $this->errorResponse('Created fail',$validator->errors()->all());
            }
            DB::beginTransaction();
            $passenger = Passenger::create([
                'passenger_name' => $params['passenger_name'],
                'passenger_tel' =>  $params['passenger_tel'],
                'passenger_email' => $params['passenger_email']
            ]);
            foreach ($params['tickets'] as $ticket) {
               Ticket::create([
                'user_id'=> 1,
                'class_id'=> 1,
                'flight_time_id'=>$ticket['flight_time_id'],
                'amount_booked'=>$ticket['amount_booked'],
                'quantity'=>$ticket['quantity'], 
                'flight_date'=>$params['flight_date'],
                'passenger_id'=>$passenger->id
               ]);
            }
            DB::commit();
            return $this->successResponse(null,'Created Successfully');

        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return $this->errorResponse();

            DB::rollBack();
            Log::info($exception->getMessage());
        }
        }
}

