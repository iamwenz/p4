@extends('layouts.master')

@section('title')
Home
@endsection

@section('head')

@endsection

@section('content')
<body>
  <div class='flex'>
    <img src="/images/home.jpg" />
    @if($user !== null)
      <h3>Welcome to Puma Lai Veterinary Clinic, {{ $user -> firstname}} {{ $user -> lastname}}</h3>
    @else
      <h3>Welcome to Puma Lai Veterinary Clinic, Please login to make appointment!</h3>
    @endif

    <div class='slideNews'>
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          @foreach($slides as $indexKey => $slide)
            @if($indexKey === 0)
              <li data-target="#myCarousel" data-slide-to="{{$indexKey}}" class='active'></li>
            @else
              <li data-target="#myCarousel" data-slide-to="{{$indexKey}}"></li>
            @endif
          @endforeach
        </ol>
        <div class="carousel-inner">
          @foreach($slides as $indexkey => $slide)
            @if($indexkey === 0)
              <div class='carousel-item active'>
                <div class='slide-shed'>

                </div>
                <img src="{{$slide->background_url}}"/>
                <div class="carousel-caption">
                    <h2 class='carousel-title'>{{$slide->title}}</h2>
                    <h4 class='carousel-subtitle'>{{$slide->sub_title}}</h4>
                    <p class='carousel-content'>{{$slide->content}}</p>
                </div>
              </div>
            @else
              <div class='carousel-item'>
                <div class='slide-shed'>

                </div>
                <img src="{{$slide->background_url}}"/>
                <div class="carousel-caption">
                  <h2 class='carousel-title'>{{$slide->title}}</h2>
                  <h4 class='carousel-subtitle'>{{$slide->sub_title}}</h4>
                  <p class='carousel-content'>{{$slide->content}}</p>
                </div>
              </div>
            @endif
          @endforeach
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="arrows carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="arrows carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </div>
</body>
@endsection
