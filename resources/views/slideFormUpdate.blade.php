@extends('layouts.master')

@section('title')
Slide_Update
@endsection

@section('head')
  <!-- javascript-->
  <script src="/js/tools.js" type="text/javascript"></script>
@endsection

@section('content')
<body>
    <div class='flex-center'>
      <h1>Update Slide</h1>
      <div id='formBody'>
        <form method="POST" action="/submit_update_slide_form/{{ $slide->id }}">
          {{ method_field('put') }}
          {{ csrf_field() }}
          <table class='table table-bordered'>
            <tr>
              <th>Title</th>
              <td>
                @if($errors->get('title'))
                  <input type="text" name="title" value="{{ old('title') }}"/>
                  <label class="error">
                      Title IS REQUIRED!
                  </label>
                @else
                  <input type="text" name="title" value="{{ $slide->title }}"/>
                @endif
              </td>
              <th>Subtitle</th>
              <td>
                @if($errors->get('sub_title'))
                  <input type="text" name="sub_title" value="{{ old('sub_title')}}"/>
                @else
                  <input type="text" name="sub_title" value="{{ $slide->sub_title }}"/>
                @endif
              </td>
            </tr>
            <tr>
              <th>Content</th>
              <td>
                @if($errors->get('content'))
                  <input type="text" name="content" value="{{ old('content') }}" />
                  <label class="error">
                      CONTENT IS REQUIRED!
                  </label>
                @else
                  <input type="text" name="content" value="{{ $slide->content }}" />
                @endif
              </td>
              <th>Active</th>
              <td>
                @if($slide->active === '1')
                  <input type="checkbox" name="active" checked='checked' />
                @else
                  <input type="checkbox" name="active" />
                @endif
              </td>
            </tr>
            <tr>
              <th>Background URL</th>
              <td>
                @if($errors->get('background_url'))
                  <input type="text" id='background_url' name="background_url" value="{{ old('background_url') }}"/>
                  <label class="error">
                      BACKGROUND IS REQUIRED!
                  </label>
                @else
                  <input type="text" id='background_url' name="background_url" value="{{ $slide->background_url }}"/>
                @endif
              </td>
              <th>
                <input type='button' class='btn btn-warning btn-xs' onClick='fetchimage()' value='show image'/>
              </th>
              <td id='display'></td>
            </tr>
          </table>

          <div align='right'>
            <input type='submit' value='submit'/>
          </div>

        </form>
      </div>
    </div>


        <script type="text/javascript">
        function fetchimage() {
          const $background_url = document.getElementById("background_url");
          const $display  = document.getElementById("display");
          const $urlString = $background_url.value;
          const $urlLength = $urlString.length;
          var $extension = '';
          var $fetchImage = '';

          if($urlString == '' || $urlString.length <5){
            $display.innerHTML = "URL field is empty or too short!";
          } else {
            $extension += $urlString.charAt($urlLength-4);
            $extension += $urlString.charAt($urlLength-3);
            $extension += $urlString.charAt($urlLength-2);
            $extension += $urlString.charAt($urlLength-1);

            if($extension !== '.jpg' && $extension !== 'jpeg' && $extension !== '.gif' && $extension !== '.png' && $extension !== '.svg') {
              alert("URL should end with jpeg, jpg, gif, png or svg.");
            } else {
              $fetchImage = document.createElement("IMG");
              $fetchImage.setAttribute('width', '500px');
              $fetchImage.setAttribute('height', '300px');
              $fetchImage.setAttribute('src', $urlString);
              $display.innetHTML = '';
              if($display.children.length > 0){
                $display.removeChild();
              }
              $display.appendChild($fetchImage);
            }

          }
          return false;
        }
        </script>
</body>
@endsection
