<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Schedule;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ScheduleController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('layouts.new_schedule');
    }

    /**
     * @return Response
     */
    public function delete(int $scheduleId)
    {
        Schedule::find($scheduleId)->delete();

        return redirect()->route('/')->with('success', 'Successfully deleted');
    }

    /**
     * @param Request $request
     * @param int|null $scheduleId
     * @return string
     */
    public function save(Request $request, ?int $scheduleId = null)
    {
        $schedule = null;

        if ($scheduleId !== null) {
            $schedule = Schedule::find($scheduleId);
        }

        $data = $request->all();

        $endIndex = intval((count($data) - 1) / 5);

        if ($schedule) {
            $schedule->update([$data['name']]);
        } else {
            $scheduleId = Schedule::create(['name' => $data['name']])->id;
        }

        for ($i = 0; $i < $endIndex; $i++) {
            $tripData = [
                'total_tickets' => $data['seatCount' . $i],
                'from' => $data['from' . $i],
                'to' => $data['to' . $i],
                'date' => $data['date' . $i],
                'schedule_id' => $scheduleId
            ];

            $tripId = $data['tripId' . $i];

            $trip = Trip::find($tripId);

            if ($trip) {
                $tripData['reserved_tickets'] = $trip->reserved_tickets;
                $trip->update($tripData);
            } else {
                $tripData['reserved_tickets'] = 0;
                Trip::create($tripData);
            }
        }

        return redirect()->route('/')->with('success', 'Successfully saved');
    }

    /**
     * @param int $scheduleId
     * @return View
     */
    public function edit(int $scheduleId): View
    {
        $schedule = Schedule::findOrFail($scheduleId);

        return view('layouts.edit_schedule')->with('schedule', $schedule);
    }

    /**
     * @return View
     */
    public function view(int $scheduleId): View
    {
        $schedule = Schedule::findOrFail($scheduleId);

        return view('layouts.schedule')->with('schedule', $schedule);
    }

    /**
     * @param int $scheduleId
     * @return View
     */
    public function report(int $scheduleId): View
    {
        $schedule = Schedule::findOrFail($scheduleId);

        $data = [];

        $trips = $schedule->trips;

        foreach ($trips as $trip) {
            $data[$trip->id] = [
                'tripName' => $trip->from . ' - ' . $trip->to,
                'reservationCount' => count($trip->reservations),
                'totalSeatCount' => $trip->total_tickets,
                'reservedTickets' => $trip->reserved_tickets,
                'ticketsLeft' => $trip->total_tickets - $trip->reserved_tickets
            ];
        }

        return view('layouts.report')->with(['data' => $data, 'schedule' => $schedule]);
    }
}
