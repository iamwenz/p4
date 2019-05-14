@extends('layouts.master')

@section('title')
Vet_Update
@endsection

@section('content')
<body>
    <div class='flex-center'>
      <div id='formBody'>
        <form method="POST" action="/submit_update_vet_form/{{ $id }}">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <table class='table table-bordered'>
            <tr>
              <th>Name</th>
              <td>
                @if($errors->get('vetName'))
                  <input type="text" name="vetName" value="{{ old('vetName') }}"/>
                  <label class="error">
                      VET'S NAME IS REQUIRED!
                  </label>
                @else
                  <input type="text" name="vetName" value="{{ $vetName }}"/>
                @endif
              </td>
              <th>Age</th>
              <td>
                @if($errors->get('vetAge'))
                  <input type="number" name="vetAge" value="{{ old('vetAge') }}"/>
                  <label class="error">
                      AGE IS REQUIRED AND MUST BE NUMBER!
                  </label>
                @else
                  <input type="number" name="vetAge" value="{{ $vetAge }}"/>
                @endif
              </td>
            </tr>
            <tr>
              <th>Female/Male</th>
              <td>
                @if($errors->get('vetGender'))
                  <select name="vetGender">
                    <option value="">Please Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>

                  <label class="error">
                      SELECT GENDER!
                  </label>
                @else
                    @if(old('vetGender') === "male" or $vetGender === 'male')
                      <select name="vetGender">
                        <option value="" disabled='disabled'>Please Select</option>
                        <option value="male" selected='selected'>Male</option>
                        <option value="female">Female</option>
                      </select>
                    @elseif(old('vetGender') === "female" or $vetGender === "female")
                        <select name="vetGender">
                          <option value="" disabled='disabled'>Please Select</option>
                          <option value="male">Male</option>
                          <option value="female" selected='selected'>Female</option>
                        </select>
                    @else
                      <select name="vetGender">
                        <option value="" selected='selected'>Please Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    @endif
                  @endif
              </td>
              <th>Years of Experience</th>
              <td>
                @if($errors->get('vetExperience'))
                  <input type="number" name="vetExperience" value="{{ old('vetExperience') }}"/>
                  <label class="error">
                      EXPERIENCE YEARS IS REQUIRED AND MUST BE TWO DIGITS NUMBER!
                  </label>
                @else
                  <input type="number" name="vetExperience" value="{{ $vetExperience }}"/>
                @endif
              </td>
            </tr>
          </table>

          @if($errors->get('vetDegree'))
            <textarea name="vetDegree" placeholder="Brief biliography of vet..."></textarea>
            <br/>
            <label class="error">
                DEGREE IS REQUIRED!
            </label>
          @elseif(old('vetDegree') !== null)
            <textarea name="vetDegree">{{ old('vetDegree') }}</textarea>
          @elseif($vetDegree !== null)
            <textarea name="vetDegree">{{ $vetDegree }}</textarea>
          @else
            <textarea name="vetDegree" placeholder="Brief biliography of vet...(max of 191 characters)"></textarea>
          @endif

          <div align='right'>
            <input type='submit' value='submit'/>
          </div>

        </form>
      </div>
    </div>
</body>
@endsection
