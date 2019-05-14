@extends('layouts.master')

@section('title')
My Appointment
@endsection

@section('content')
<body>
  <div class='flex-center'>
        @if($alertText !== '')
          <div class='textBox'>
            <p class='alert'>
              {{ $alertText}}
            </p>
          </div>
        @endif
        @if($successText !== '')
          <div class='textBox'>
            <p class='success'>
              {{ $successText }}
            </p>
          </div>
        @endif
        <table class='table table-bordered'>
          <thead>
            <tr>
              <th>
                ID
              </th>
              <th>
                Appointment Time
              </th>
              <th>
                Pet Name
              </th>
              <th>
                Species
              </th>
              <th>
                Breed
              </th>
              <th>
                Birth Year
              </th>
              <th>
                Gender
              </th>
              <th>
                Vet
              </th>
              <th>
                Symptom
              </th>
              <th>
                Cancel Appointment
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($appointments as $appointment)
            <tr>
              <td>
                {{ $appointment->id }}
              </td>
              <td>
                {{ $appointment->appointment_time }}
              </td>
              <td>
                {{ $appointment->pet_name }}
              </td>
              <td>
                {{ $appointment->species }}
              </td>
              <td>
                {{ $appointment->breed }}
              </td>
              <td>
                {{ $appointment->birth_year }}
              </td>
              <td>
                {{ $appointment->gender }}
              </td>
              <td>
                {{ $appointment->veterinarians->get(0)->vetName}}
              </td>
              <td>
                {{ $appointment->symptom }}
              </td>
              <td>
                <form method='POST' action='/cancel_appointment/{{ $appointment->id }}'>
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <input type='submit' value='cancel' class='btn btn-warning btn-xs'>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class='textBox'>
          <p>
            Greeting, {{$user->firstname}}! You have already made {{$appointments->count()}} appointments.
          </p>
        </div>
  </div>
</body>
@endsection
