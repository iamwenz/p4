<!doctype html>
<html lang='en'>
<head>
  <title>@yield('title')</title>
  <meta charset='utf-8'>
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- local stylesheet-->
  <link href="/css/master.css" type="text/css" rel="stylesheet">

  <style>
    html, body {
      background-color: #fff;
      color: #636b6f;
      font-family: 'Nunito', sans-serif;
      font-weight: 200;
      height: 100vh;
      margin: 0;
    }
  </style>
  @yield('head')
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="/">PumaLai Vet</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          @if(Auth::check())
            @if( $user -> firstname  === 'rootuser')
            <li class='nav-item'>
              <a class="nav-link" href='/'>Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/veterinarians">Veterinarian</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/billboard">Billboard</a>
              </div>
            </li>
            @else
              <li class='nav-item'>
                <a class="nav-link" href='/'>Home</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Appointment
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="/make_appointment">Make Appointment</a>
                  <a class="dropdown-item" href="/appointment/{{$user -> id}}">My Appointment</a>
                </div>
              </li>
            @endif
          @else
            <li class='nav-item'>
              <a class="nav-link" href='./'>Home</a>
            </li>
            <li class='nav-item'>
              <a class="nav-link" href='./register'>Register</a>
            </li>
            <li class='nav-item'>
              <a class="nav-link" href='./login'>Login</a>
            </li>
          @endif
        </ul>
        @if(Auth::check())
        <div id='logout-container'>
          <form method='POST' id='logout' action='/logout'>
            {{ csrf_field() }}
            <a href='#' onClick='document.getElementById("logout").submit();'>Logout</a>
          </form>
        </div>
        @endif
      </div>
    </nav>
  </header>

  <section>
    @yield('content')
  </section>
  <footer>
    <div>
      <h5>&copy; Puma Lai {{ date('Y')}}</h5>
    </div>
  </footer>

</body>
</html>
