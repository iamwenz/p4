@extends('layouts.master')

@section('title')
Vet_List
@endsection

@section('content')
<body>
  <nav class='subNav'>
    <ul>
      <li>
        Add New Vat
      </li>
    </ul>
  </nav>
  <div class='flex'>
    <table>
      <thead>
          <tr>
            <th>id</th><th>name</th><th>age</th><th>degree</th>
          </tr>
      </thead>
      <tbody>
        @foreach($vets as $vet)
          <tr>
            <td>
                {{$vet->id}}
            </td>
            <td>
                {{$vet->name}}
            </td>
            <td>
                {{$vet->age}}
            </td>
            <td>
                {{$vet->degree}}
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</body>
@endsection
