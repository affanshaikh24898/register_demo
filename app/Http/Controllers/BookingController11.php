<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use DB;
class BookingController extends Controller
{

    public function index()
    {
        $bookings = Booking::latest()->paginate(2);

        return view('bookings.index',compact('bookings'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }


    public function create()
    {
        return view('bookings.create');
    }


    public function store(Request $request)
    {
        $check_date = $request["booking_date"];
        $date_check1 = Booking::where('booking_date','=',$check_date)
            ->where('booking_type', '=', 'full day')->count();
        if($date_check1 != 1){
            $date_check2 = Booking::where('booking_date','=',$check_date)
                            ->where('booking_type', '=', 'half day')->count();
            if($date_check2 > 0 && $request["booking_type"] == "half day"){
                $date_check3 = Booking::where('booking_date','=',$check_date)
                        ->where('booking_slot', '=', $request["booking_slot"])->count();
                if($date_check3 != 1){
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'booking_type' => 'required',
                        'booking_date' => 'required',
                        'booking_slot' => 'required',
                        'booking_time' => 'required',
                    ]);

                    $input = $request->all();
                    Booking::create($input);

                    return redirect()->route('bookings.index')
                                    ->with('success','booking created successfully.');
                }else{
                    return redirect()->route('bookings.create')
                                ->with('success','this date is picked for this slot booking, you can book another slot');

                }
            }else{
                return redirect()->route('bookings.create')
                            ->with('success','this date is picked for half day booking, you can book only half day');

            }
        }else{
            return redirect()->route('bookings.create')
                        ->with('success','this date is picked for full day booking');

        }
    }


    public function show(Booking $booking)
    {
        return view('bookings.show',compact('booking'));
    }


    public function edit(Booking $booking)
    {
        return view('bookings.edit',compact('booking'));
    }


    public function update(Request $request, Booking $booking)
    {
        $check_date = $request["booking_date"];
        //$fatch_date =  Booking::where('booking_date','=',$check_date)->get();

        $date_check = Booking::where('booking_date','=',$check_date)
            ->where('booking_type', '=', 'full day')->count();
        if($date_check != 1){
            $date_check2 = Booking::where('booking_date','=',$check_date)
                ->where('booking_type', '=', 'half day')->count();
            if($date_check2 > 0 && $request["booking_type"] == "half day"){
                $date_check3 = Booking::where('booking_date','=',$check_date)
                        ->where('booking_slot', '=', $request["booking_slot"])->count();
                if($date_check3 != 1){
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required|email|unique:users',
                        'booking_type' => 'required',
                        'booking_date' => 'required',
                        'booking_slot' => 'required',
                        'booking_time' => 'required',
                    ]);

                    $input = $request->all();
                    Booking::create($input);

                    return redirect()->route('bookings.index')
                                    ->with('success','booking updated successfully.');
                }else{
                    return redirect()->route('bookings.edit',compact('booking'))
                            ->with('success','this date is picked for this slot booking, you can book another slot');

                }
            }else{
                return redirect()->route('bookings.edit',compact('booking'))
                        ->with('success','this date is picked for half day booking, you can book only half day');

            }
        }else{
         return redirect()->route('bookings.edit',compact('booking'))
                ->with('success','this date is picked for full day booking');

        }
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
                        ->with('success','booking deleted successfully');
    }
}
