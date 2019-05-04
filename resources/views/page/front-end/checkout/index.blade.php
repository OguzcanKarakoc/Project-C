@extends('layout.app')

@section('content')
  <div class="container">
    <div class="row">
      @include('component.flash-message')
    </div>
    <div class="row">
      <div class="col-6">
        <h2>Login</h2>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">

              <div class="card-body">
                <form method="POST" action="{{ url('/signin ') }}">
                  @csrf

                  <div class="form-group row">
                    <label for="email"
                           class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                      <input id="email" type="email"
                         class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                         name="email" value="{{ old('email') }}" required autofocus>

                      @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="password"
                           class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                      <input id="password" type="password"
                             class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                             name="password" required>

                      @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                      @endif
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                          {{ __('Remember Me') }}
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                        {{ __('Signin') }}
                      </button>

                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-6">
        <h2>Guest</h2>
        <form action="{{ route('order.store') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="first_name">First name</label>
            <input id="first_name" name="first_name" type="text" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="last_name">Last name</label>
            <input id="last_name" name="last_name" type="text" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="phone_number">Phone number</label>
            <input id="phone_number" name="phone_number" type="text" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control"/>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" class="form-control"/>
          </div>
          <fieldset class="form-group">
            <legend>Address</legend>
            <div class="form-group">
              <label for="postcode">Postcode</label>
              <input id="postcode" name="postcode" type="text" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="city">City</label>
              <input id="city" name="city" type="text" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="street">Street</label>
              <input id="street" name="street" type="text" class="form-control"/>
            </div>
            <div class="form-group">
              <label for="house_number">House number</label>
              <input id="house_number" name="house_number" type="text" class="form-control"/>
            </div>
          </fieldset>
          <div class="form-group">
            <label>
              <input type="submit" class="form-control"/>
            </label>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection