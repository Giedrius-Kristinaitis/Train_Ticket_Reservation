@extends('layouts.app')

@section('content')
    <h3>Reserve tickets for trip: {{ $trip->from }} - {{ $trip->to }}</h3>

    <br/>
    <p>Available tickets: {{ $trip->total_tickets - $trip->reserved_tickets  }}</p>
    <br/>

    <form method="post" action="{{ route('reservation.place') }}">
        <div class="form-group">
            <label for="ticketCount">How many tickets to reserve</label>
            <input type="text" class="form-control" name="ticketCount" placeholder="Enter ticket count">
        </div>
        <input type="hidden" class="form-control" name="userId"
               value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
        <input type="hidden" class="form-control" name="tripId"
               value="{{ $trip->id }}">
        <button type="submit" class="btn btn-primary">Reserve</button>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>
@endsection