@extends('layouts.master')

@section('title')
Vet_List
@endsection

@section('content')
<body>
  <nav class='subNav'>
    <ul>
      <li>
        <a href='/add_slide'>Add Slide</a>
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
    <h1>Billboard Dashboard</h1>
    <table class='table table-bordered'>
      <thead>
          <tr>
            <th>id</th><th>title</th><th>sub title</th><th>content</th><th>active</th></th><th>background</th><th>update</th><th>delete</th>
          </tr>
      </thead>
      <tbody>
        @foreach($slides as $slide)
          <tr>
            <td>
                {{$slide->id}}
            </td>
            <td>
                {{$slide->title}}
            </td>
            <td>
                {{$slide->sub_title}}
            </td>
            <td>
                {{$slide->content}}
            </td>
            <td>
              @if($slide->active === '1')
                active
              @else
                inactive
              @endif
            </td>
            <td>
              <img class='slide-image' src='{{$slide->background_url}}' width='600' height='400'>
            </td>
            <td>
              <form action="/update_slide/{{$slide->id}}">
                <input type="submit" value="update" class='btn btn-primary btn-xs' />
              </form>
            </td>
            <td>
                <form method='POST' action='/delete_slide/{{$slide->id}}'>
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
