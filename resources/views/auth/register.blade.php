@extends('layouts.master')
@section('title')
REGISTER
@endsection

@section('content')
<div class='flex-center'>
  <form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <h1>Register</h1>
    <div>
      <p>
        Already have an account? <a href='./login'>login here</a>
      </p>
    </div>
    <table class='table table-bordered'>
        <tbody>
          <tr>
            <th>
              First Name
            </th>
            <td>
              <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autofocus>
              @error('firstname')
                <span class="invalid-feedback" role="alert">
                  <strong>first name is required and less than 191 characters.</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Last Name
            </th>
            <td>
              <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autofocus>
              @error('lastname')
                <span class="invalid-feedback" role="alert">
                  <strong>last name is required and less than 191 characters.</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Email
            </th>
            <td>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Phone
            </th>
            <td>
              <input id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
              @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>phone is required and less than 191 characters</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Address
            </th>
            <td>
              <input id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
              @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>address is required and less than 191 characters</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Password
            </th>
            <td>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </td>
          </tr>
          <tr>
            <th>
              Password Confirm
            </th>
            <td>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </td>
          </tr>
          <tr>
            <th colspan="2">
              <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
              </button>
            </th>
          </tr>
        </tbody>
    </table>
  </form>
</div>

@endsection
