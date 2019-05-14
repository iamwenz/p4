@extends('layouts.master')

@section('title')
Vet_List
@endsection

@section('content')
<body>
  <nav class='subNav'>
    <ul>
      <li>
        <a href='/add_vet'>Add Vet</a>
      </li>
    </ul>
  </nav>
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
  <div class='flex'>
    <h1>Veterinarian Dashboard</h1>
    <table class='table table-bordered'>
      <thead>
          <tr>
            <th>id</th><th>name</th><th>age</th><th>gender</th><th>degree</th><th>experience</th><th>update</th><th>delete</th>
          </tr>
      </thead>
      <tbody>
        @foreach($vets as $vet)
          <tr>
            <td>
                {{$vet->id}}
            </td>
            <td>
                {{$vet->vetName}}
            </td>
            <td>
                {{$vet->vetAge}}
            </td>
            <td>
              {{$vet->vetGender}}
            </td>
            <td>
                {{$vet->vetDegree}}
            </td>
            <td>
              {{$vet->vetExperience}} yrs
            </td>
            <td>
              <form action="/update_vet/{{$vet->id}}">
                <input type="submit" value="update" class='btn btn-primary btn-xs' />
              </form>
            </td>
            <td>
                <form method='POST' action='/delete_vet/{{$vet->id}}'>
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <input type='submit' value='delete' class='btn btn-warning btn-xs'>
                </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
@endsection
