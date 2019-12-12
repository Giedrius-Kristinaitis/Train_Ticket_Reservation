@extends('layouts.app')

@section('content')
    <div style="margin: 28px 0" class="card">
        <h1>Train Ticket Reservation System</h1>
        <p>Author: Giedrius Kristinaitis IFF-7/2</p>
    </div>

    @if (\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('success') }}
        </div>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ \Illuminate\Support\Facades\Session::get('error') }}
        </div>
    @endif

    @php
        $schedules = \App\Schedule::all();
        $user = \Illuminate\Support\Facades\Auth::user();
    @endphp

    @if ($user && $user->hasRole(\App\Role::ROLE_ADMIN))
        <a href="{{ route('schedule.create') }}" class="btn btn-primary">Create Schedule</a>
    @endif

    @if ($user)
        <a href="{{ route('reservation.all') }}" class="btn btn-primary">My Reservations</a>
    @endif

    <h1>All Schedules</h1>

    <hr/>
    @if ($schedules->count() > 0)
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col"></th>

                @if ($user && $user->hasRole(\App\Role::ROLE_ADMIN))
                    <th scope="col"></th>
                    <th scope="col"></th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($schedules as $schedule)
                <tr>
                    <td scope="row">{{ $schedule->id }}</td>
                    <td>{{ $schedule->name }}</td>

                    <td><a href="{{ route('schedule.view', $schedule->id) }}"
                           class="edit-schedule btn btn-primary">View</a></td>

                    @if ($user && $user->hasRole(\App\Role::ROLE_ADMIN))
                        <td>
                            <a href="{{ route('schedule.edit', ['scheduleId' => $schedule->id, 'schedule' => $schedule]) }}"
                               class="edit-schedule btn btn-primary">Edit</a></td>
                        <td>
                            <form method="post" action="{{ route('schedule.delete', $schedule->id) }}">
                                <button type="submit"
                                        class="delete-schedule btn btn-primary">Delete
                                </button>
                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h2>No schedules</h2>
    @endif
@endsection