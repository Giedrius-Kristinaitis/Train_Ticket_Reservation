@extends('layouts.app')

@section('content')
    <h1>Schedule {{ $schedule->name }} Report</h1>

    @if (count($data) > 0)
        <h2>Trip Reports</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Route</th>
                <th scope="col">Reservation Count</th>
                <th scope="col">Train's Seat Count</th>
                <th scope="col">Reserved tickets</th>
                <th scope="col">Tickets left</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $trip)
                <tr>
                    <th scope="row">{{ $trip['tripName'] }}</th>
                    <td>{{ $trip['reservationCount'] }}</td>
                    <td>{{ $trip['totalSeatCount'] }}</td>
                    <td>{{ $trip['reservedTickets'] }}</td>
                    <td>{{ $trip['ticketsLeft'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>The schedule has no trips - nothing to show</h3>
    @endif
@endsection