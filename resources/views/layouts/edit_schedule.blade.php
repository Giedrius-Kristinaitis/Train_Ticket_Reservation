@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('schedule.save') }}">
        <h1>Edit Schedule</h1>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter schedule name" value="{{ $schedule->name }}">
        </div>
        <hr/>
        <div>
            <h2>Trips</h2>
            <div class="tripsContainer">
                @foreach ($schedule->trips as $trip)
                    <div class="row">
                        <div class="form-group">
                            <label for="seatCount">Train ticket count</label>
                            <input type="number" class="form-control" name="seatCount0"
                                   placeholder="Enter train's available ticket count"
                                   value="{{ $trip->total_tickets }}">
                        </div>
                        <div class="form-group">
                            <label for="from">Train leaving from</label>
                            <input type="text" class="form-control" name="from0"
                                   placeholder="Enter trip's starting location"
                                   value="{{ $trip->from }}">
                        </div>
                        <div class="form-group">
                            <label for="to">Train arriving at</label>
                            <input type="text" class="form-control" name="to0" placeholder="Enter destination"
                                   value="{{ $trip->to }}">
                        </div>
                        <div class="form-group">
                            <label for="date">Trip date</label>
                            <input type="date" class="form-control" name="date0"
                                   value="{{ substr($trip->date, 0, 10) }}">
                        </div>
                        <input type="hidden" name="tripId0" value="{{ $trip->id }}"/>
                    </div>
                @endforeach
            </div>
            <br/>
            <br/>
            <a class="addTrip btn btn-primary">Add another trip</a>
        </div>
        <br/>
        <br/>
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        <button type="submit" class="btn btn-primary">Save schedule</button>
    </form>
@endsection

<script defer>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.querySelector('.addTrip');
        const tripsContainer = document.querySelector('.tripsContainer');
        let index = 1;

        addButton.addEventListener('click', function () {
            const row = document.createElement('div');
            row.classList.add('row');

            const divider = document.createElement('hr');
            tripsContainer.appendChild(divider);

            const ticketInputContainer = document.createElement('div');
            ticketInputContainer.classList.add('form-group');
            const ticketInputLabel = document.createElement('label');
            ticketInputLabel.setAttribute('for', 'seatCount' + index);
            ticketInputLabel.innerHTML = 'Train ticket count';
            const ticketInput = document.createElement('input');
            ticketInput.classList.add('form-control');
            ticketInput.setAttribute('name', 'seatCount' + index);
            ticketInput.setAttribute('type', 'number');
            ticketInput.setAttribute('placeholder', "Enter train's available ticket count");
            ticketInputContainer.appendChild(ticketInputLabel);
            ticketInputContainer.appendChild(ticketInput);
            row.appendChild(ticketInputContainer);

            const fromInputContainer = document.createElement('div');
            fromInputContainer.classList.add('form-group');
            const fromInputLabel = document.createElement('label');
            fromInputLabel.setAttribute('for', 'from' + index);
            fromInputLabel.innerHTML = 'Train leaving from';
            const fromInput = document.createElement('input');
            fromInput.classList.add('form-control');
            fromInput.setAttribute('name', 'from' + index);
            fromInput.setAttribute('type', 'text');
            fromInput.setAttribute('placeholder', "Enter trip's starting location");
            fromInputContainer.appendChild(fromInputLabel);
            fromInputContainer.appendChild(fromInput);
            row.appendChild(fromInputContainer);

            const toInputContainer = document.createElement('div');
            toInputContainer.classList.add('form-group');
            const toInputLabel = document.createElement('label');
            toInputLabel.setAttribute('for', 'to' + index);
            toInputLabel.innerHTML = 'Train arriving at';
            const toInput = document.createElement('input');
            toInput.classList.add('form-control');
            toInput.setAttribute('name', 'to' + index);
            toInput.setAttribute('type', 'text');
            toInput.setAttribute('placeholder', "Enter train's destination");
            toInputContainer.appendChild(toInputLabel);
            toInputContainer.appendChild(toInput);
            row.appendChild(toInputContainer);

            const dateInputContainer = document.createElement('div');
            dateInputContainer.classList.add('form-group');
            const dateInputLabel = document.createElement('label');
            dateInputLabel.setAttribute('for', 'date' + index);
            dateInputLabel.innerHTML = 'Train ticket count';
            const dateInput = document.createElement('input');
            dateInput.classList.add('form-control');
            dateInput.setAttribute('name', 'date' + index);
            dateInput.setAttribute('type', 'date');
            dateInputContainer.appendChild(dateInputLabel);
            dateInputContainer.appendChild(dateInput);
            row.appendChild(dateInputContainer);

            const idInput = document.createElement('input');
            idInput.setAttribute('type', 'hidden');
            idInput.setAttribute('name', 'tripId' + index);
            idInput.setAttribute('value', '');
            row.appendChild(idInput);

            tripsContainer.appendChild(row);

            index++;
        });
    });
</script>