@extends('layouts.app')

@section('content')
    <h1>My Reservations</h1>

    <hr/>
    @if ($reservations->count() > 0)
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Trip</th>
                <th scope="col">Reserved tickets</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <th scope="row">{{ $reservation->id }}</th>
                    <td>{{ $reservation->trip->from }} - {{ $reservation->trip->to }}</td>
                    <td>{{ $reservation->ticket_count }}</td>
                    <td>
                        <form method="post" action="{{ route('reservation.cancel', $reservation->id) }}">
                            <button
                                    class="cancel-reservation btn btn-primary">Cancel reservation
                            </button>
                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2>No reservations</h2>
    @endif
@endsection