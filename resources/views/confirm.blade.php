@extends('layouts.master')

@section('title')
Home
@endsection

@section('head')
<!-- Styles-->
<link href="/css/confirmation.css" type="text/css" rel="stylesheet">

@endsection

@section('content')
<body>
  <div class='flex-center'>
    <h3>Congradulation! Form Submitted!</h3>
    <table>
      <tr>
        <th>Species</th>
        <td>{{$species}}</td>
        <th>Age</th>
        <td>{{$age}}</td>
      </tr>
      <tr>
        <th>Female/Male</th>
        <td>{{$gender}}
        </td>
        <th>visited</th>
        <td>
          @if($visited == 'on')
            I have visited before.
          @else
            This is my first time.
          @endif
        </td>
      </tr>
      <tr>
        <th class="symptom" colspan="4">
          SYMPTOM
        </th>
      </tr>
      <tr>
        <td class="symptom" colspan="4">
          {{$symptom}}
        </td>
      </tr>
    </table>
    <a href="/">Back To Home Page</a>
  </div>
</body>
@endsection
