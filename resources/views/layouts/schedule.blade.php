@extends('layouts.app')

@section('content')
    <h1>Schedule: {{ $schedule->name }}</h1>

    @php
        $user = \Illuminate\Support\Facades\Auth::user();
        $trips = \App\Schedule::findOrFail($schedule->id)->trips;
    @endphp

    @if ($user && $user->hasRole(\App\Role::ROLE_MANAGER))
        <a href="{{ route('schedule.report', $schedule->id) }}" class="btn btn-primary">View Schedule Report</a>
    @endif

    <hr/>
    @if ($trips->count() > 0)
        <h2>Trips</h2>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Available tickets</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Date</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($trips as $trip)
                <tr>
                    <th scope="row">{{ $trip->total_tickets - $trip->reserved_tickets }}</th>
                    <td>{{ $trip->from }}</td>
                    <td>{{ $trip->to }}</td>
                    <td>{{ $trip->date }}</td>
                    <td>
                        @if ($user)
                            @if ($trip->total_tickets - $trip->reserved_tickets > 0)
                                <a href="{{ route('reservation.reserve', $trip->id) }}"
                                   class="reserve-tickets btn btn-primary">Reserve tickets</a>
                            @else
                                <p>No tickets left</p>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2>No trips in the schedule</h2>
    @endif

    @if (!$user)
        <h4>You need to create an account to reserve tickets</h4>
    @endif
@endsection