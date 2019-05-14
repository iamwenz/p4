@extends('layouts.master')
@section('title')
LOGIN
@endsection
@section('content')
<div class='flex-center'>
  <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <h1>Login</h1>
    <table class='table table-bordered'>
      <tbody>
        <tr>
          <th>
            Email
          </th>
          <td>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
              <span role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </td>
        </tr>
        <tr>
          <th>
            Password
          </th>
          <td>
            <input id="password" type="password" name="password" required>
            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </td>
        </tr>
        <tr>
          <th colspan="2">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
            </label>
          </th>
        </tr>
        <tr>
          <th colspan="2">
            <button type="submit" class="btn btn-primary">
              {{ __('Login') }}
            </button>
          </th>
        </tr>
      </tbody>
    </table>

    @if (Route::has('password.request'))
    <div class='textBox'>
      <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
      </a>
    </div>
    @endif
  </form>
  </div>
@endsection
