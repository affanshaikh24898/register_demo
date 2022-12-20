<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

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
        $fetch_date =  Booking::select('booking_type','booking_slot')
                        ->where('booking_date','=',$request["booking_date"])->get();
        $fetch_count =  Booking::where('booking_date','=',$request["booking_date"])->count();


        //dd($fetch_date[0]->booking_type,$fetch_date[0]->booking_slot);
        if($fetch_count == 0){
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
                            ->with('success','Booking created successfully.');
        }
        if($fetch_count == 2){
            return redirect()->route('bookings.create')
                     ->with('success','all slots are booked for this day');
        }
        if($fetch_date[0]->booking_type == "full day"){
            return redirect()->route('bookings.create')
                        ->with('success','this date is picked for full day booking');
        }
        if($request["booking_type"] == "full day"){
            return redirect()->route('bookings.create')
                         ->with('success','this date is picked for half day booking you can choose half day only');
        }
        if($fetch_date[0]->booking_slot == $request["booking_slot"]){
            return redirect()->route('bookings.create')
                                ->with('success','this date is picked for this slot booking, you can book another slot');
        }

        $request->validate([
            'name' => 'required',
            //'email' => 'required|email|unique:users',
            'booking_type' => 'required',
            'booking_date' => 'required',
            'booking_slot' => 'required',
            'booking_time' => 'required',
        ]);

        $input = $request->all();
        Booking::create($input);

        return redirect()->route('bookings.index')
                        ->with('success','Booking created successfully.');

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
        $fetch_date =  Booking::select('booking_type','booking_slot')
                        ->where('booking_date','=',$request["booking_date"])->get();
        $fetch_count =  Booking::where('booking_date','=',$request["booking_date"])->count();


        //dd($fetch_date[0]->booking_type,$fetch_date[0]->booking_slot);
        if($fetch_count == 0){
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'booking_type' => 'required',
                'booking_date' => 'required',
                'booking_slot' => 'required',
                'booking_time' => 'required',
            ]);

            $input = $request->all();
            Booking::update($input);

            return redirect()->route('bookings.index')
                            ->with('success','Booking updated successfully.');
        }
        if($fetch_count == 2){
            return redirect()->route('bookings.create')
                     ->with('success','all slots are booked for this day');
        }
        if($fetch_date[0]->booking_type == "full day"){
            return redirect()->route('bookings.edit',compact('booking'))
                        ->with('success','this date is picked for full day booking');
        }
        if($request["booking_type"] == "full day"){
            return redirect()->route('bookings.edit',compact('booking'))
                         ->with('success','this date is picked for half day booking you can choose half day only');
        }
        if($fetch_date[0]->booking_slot == $request["booking_slot"]){
            return redirect()->route('bookings.edit',compact('booking'))
                                ->with('success','this date is picked for this slot booking, you can book another slot');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'booking_type' => 'required',
            'booking_date' => 'required',
            'booking_slot' => 'required',
            'booking_time' => 'required',
        ]);

        $input = $request->all();
        Booking::update($input);

        return redirect()->route('bookings.index')
                        ->with('success','Booking updated successfully.');
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
                        ->with('success','Product deleted successfully');
    }
}

