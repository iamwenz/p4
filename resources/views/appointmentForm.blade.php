@extends('layouts.master')

@section('title')
Vet_Register
@endsection

@section('content')
<body>
    <div class='flex-center'>
      <h1>Appointment Form</h1>
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
      <div id='formBody'>
        <form method="POST" action="/submit_appointment_form">
          {{ csrf_field() }}
          <table class='table table-bordered'>
            <tr>
              <th>Appointment Time</th>
              <td>
                @if($errors->get('appointment_time'))
                  <input type="text" name="appointment_time" value="{{ old('appointment_time') }}" readonly='readonly'/>
                  <label class="error">
                      APPOINTMENT TIME IS REQUIRED!
                  </label>
                @else
                  @if($appointment_time !== null)
                    <input type="text" name="appointment_time" value="{{ $appointment_time }}" readonly='readonly'/>
                  @else
                    <input type="text" name="appointment_time" value="{{ old('appointment_time') }}" readonly='readonly'/>
                  @endif
                @endif
              </td>
              <th>Pet Name</th>
              <td>
                <input type="text" name="pet_name" value="{{ old('pet_name') }}"/>
                @if($errors->get('pet_name'))
                  <label class="error">
                      PET NAME IS REQUIRED!
                  </label>
                @endif
              </td>
            </tr>
            <tr>
              <th>Female/Male</th>
              <td>
                @if($errors->get('gender'))
                  <select name="gender">
                    <option value="">Please Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>

                  <label class="error">
                      SELECT PET GENDER!
                  </label>
                  @else
                    @if(old('gender') === "male")
                      <select name="gender">
                        <option value="" disabled='disabled'>Please Select</option>
                        <option value="male" selected='selected'>Male</option>
                        <option value="female">Female</option>
                      </select>
                    @elseif(old('gender') === "female")
                        <select name="gender">
                          <option value="" disabled='disabled'>Please Select</option>
                          <option value="male">Male</option>
                          <option value="female" selected='selected'>Female</option>
                        </select>
                    @else
                      <select name="gender">
                        <option value="" selected='selected'>Please Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    @endif
                  @endif
              </td>
              <th>Species</th>
              <td>
                <input type="text" name="species" value="{{ old('species') }}"/>
                @if($errors->get('species'))
                  <label class="error">
                      SPECIES IS REQUIRED!
                  </label>
                @endif
              </td>
            </tr>
            <tr>
              <th>Breed</th>
              <td>
                <input type="text" name="breed" value="{{ old('breed') }}"/>
                @if($errors->get('breed'))
                  <label class="error">
                      BREED IS REQUIRED!
                  </label>
                @endif
              </td>
              <th>Year of Birth</th>
              <td>
                <input type="number" name="birth_year" value="{{ old('birth_year') }}"/>
                @if($errors->get('birth_year'))
                  <label class="error">
                      BIRTH YEAR IS REQUIRED!
                  </label>
                @endif
              </td>
            </tr>
            <tr>
              <th>Veterinarian ID</th>
              <td>
                @if($errors->get('vet_id'))
                  <input type="text" name="vet_id" value="{{ old('vet_id') }}" readonly='readonly'/>
                    <label class="error">
                      Vet ID IS REQUIRED!
                    </label>
                @else
                  <input type="text" name="vet_id" value="{{ $vet_id }}" readonly='readonly'/>
                @endif
              </td>
              <th>Veterinarian Name</th>
              <td>
                {{$vet_name}}
              </td>
            </tr>
          </table>

          @if($errors->get('symptom'))
            <textarea name="symptom" placeholder="Brief symptom of pet...(max of 191 characters)"></textarea>
            <br/>
            <label class="error">
                SYMPTOM IS REQUIRED!
            </label>
          @elseif(old('symptom') !== null)
            <textarea name="symptom">{{ old('symptom') }}</textarea>
          @else
            <textarea name="symptom" placeholder="Brief symptom of pet...(max of 191 characters)"></textarea>
          @endif

          <div align='right'>
            <input type='submit' value='submit'/>
          </div>

        </form>
      </div>
    </div>
</body>
@endsection
