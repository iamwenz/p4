@extends('layouts.master')

@section('title')
Appointment Calendar
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
    <form method="POST" action="/submit_appointment_vet">
        {{ csrf_field() }}
        <table class='table table-bordered'>
          <tbody>
            <tr>
              <th>
                Vet Name
              </th>
              <td>
                <select name="vet_id">
                  <option value="">Please Select</option>
                  @if($selectedVet !== '')
                    @foreach($vets as $vet)
                      @if($selectedVet->id === $vet->id)
                        <option value="{{ $vet -> id }}" selected='selected'>{{$vet -> vetName}}</option>
                      @else
                        <option value="{{ $vet -> id }}">{{$vet -> vetName}}</option>
                      @endif
                    @endforeach
                  @else
                    @foreach($vets as $vet)
                      <option value="{{ $vet -> id }}">{{$vet -> vetName}}</option>
                    @endforeach
                  @endif

                </select>
              </td>
              <td>
                <input type='submit' value='submit'/>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
      <div class='flex-center'>
        @if($scheduledVet !== '')
          <table class='table table-bordered schedule'>
            <tbody>
              @for($i = 0; $i < 6; $i++)
                <tr>
                  @for($j = 0; $j < 7; $j++)
                    <td>
                      @if($availableSlot[$i][$j] !== '')
                      <form method="POST" action="/submit_appointment_slot">
                        {{ csrf_field() }}
                        <input name='appointment_time' type='hidden' readonly='readonly' value='{{ $availableSlot[$i][$j] }}' />
                        <input name='vet_id' type='hidden' readonly = 'readonly' value='{{$scheduledVet->id}}' />
                        <input type='submit' class='calendar-button' value='{{ $availableSlot[$i][$j] }}'/>
                      </form>
                      @endif
                    </td>
                    @endfor
                  </tr>
                  @endfor
                </tbody>
          </table>
        @endif
    </div>
  </div>
</body>
@endsection
