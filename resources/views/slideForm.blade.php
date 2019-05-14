@extends('layouts.master')

@section('title')
Add_Slide
@endsection

@section('content')
<body>
    <div class='flex-center'>
      <h1>Add Slide</h1>
      <div id='formBody'>
        <form method="POST" action="/submit_slide_form">
          {{ csrf_field() }}

          <table class='table table-bordered'>
            <tr>
              <th>Title</th>
              <td>
                <input type="text" name="title" value="{{ old('title') }}"/>
                @if($errors->get('title'))
                  <label class="error">
                      TITLE IS REQUIRED!
                  </label>
                @endif
              </td>
              <th>Subtitle</th>
              <td>
                <input type="text" name="sub_title" value="{{ old('sub_title') }}"/>
                @if($errors->get('sub_title'))
                  <label class="error">
                      {{$message}}
                  </label>
                @endif
              </td>
            </tr>
            <tr>
              <th>Content</th>
              <td>
                <input type="text" name="content" value="{{ old('content') }}" />
                @if($errors->get('content'))
                  <label class="error">
                      CONTENT IS REQUIRED!
                  </label>
                @endif
              </td>
              <th>Active</th>
              <td>
                @if(old('active') == 'on')
                  <input type="checkbox" name="active" checked='checked'/>
                @else
                  <input type="checkbox" name="active"/>
                @endif
              </td>
            </tr>
            <tr>
              <th>Background URL</th>
              <td>
                <input type="text" id="background_url" name="background_url" value="{{ old('background_url') }}"/>
                @if($errors->get('background_url'))
                  <label class="error">
                      BACKGROUND IS REQUIRED!
                  </label>
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
