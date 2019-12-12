<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Reservation;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * @return View
     */
    public function all(): View
    {
        $reservations = Reservation::where('user_id', Auth::user()->id);

        return view('layouts.my_reservations')->with('reservations', $reservations->get());
    }

    /**
     * @return Response
     */
    public function place(Request $request)
    {
        $data = $request->all();

        $reservationData = [
            'user_id' => $data['userId'],
            'trip_id' => $data['tripId'],
            'ticket_count' => $data['ticketCount']
        ];

        Reservation::create($reservationData);

        $trip = Trip::findOrFail($data['tripId']);

        $tripData = [
            'reserved_tickets' => $trip->reserved_tickets + intval($data['ticketCount'])
        ];

        $trip->update($tripData);

        return redirect()->route('/')->with('success', 'Successfully reserved');
    }

    /**
     * @return Response
     */
    public function cancel(int $id)
    {
        $reservation = Reservation::findOrFail($id);

        $trip = Trip::findOrFail($reservation->trip_id);

        $tripData = [
            'reserved_tickets' => $trip->reserved_tickets - $reservation->ticket_count
        ];

        $trip->update($tripData);

        $reservation->delete();

        return redirect()->route('/')->with('success', 'Successfully canceled');
    }

    /**
     * @param int $tripId
     * @return View
     */
    public function reserve(int $tripId): View
    {
        $trip = Trip::findOrFail($tripId);

        return view('layouts.reserve_tickets')->with('trip', $trip);
    }
}
