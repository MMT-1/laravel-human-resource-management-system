<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{asset('front/assets/images/favicon.png')}}" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{asset('front/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('front/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('front/login/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('front/login/fonts/icomoon/style.css')}}">
</head>
@section('title') Login @endsection

<div class="d-lg-flex half">
  <div class="bg order-1 order-md-2" style="background-image: url('{{asset('front/assets/images/1682747491.jpg')}}');">
  </div>
  <div class="contents order-2 order-md-1">

    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-6">
          <h3>Login to <strong>Website</strong></h3>
          <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur adipisicing.</p>
          <span style="color:red">
            {{-- message --}}
                {!! Toastr::message() !!}
          </span>
          <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group first">
              <label for="username">Email</label>
              <input type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="your-email@gmail.com" id="username" name="email">
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group last mb-3 mt-3">
              <label for="password">Password</label>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Your Password" id="password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="d-flex mb-3 align-items-center">
              <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                <input type="checkbox" checked="checked" />
                <div class="control__indicator"></div>
              </label>
              <span class="ms-auto"><a href="{{ route('forget-password') }}" class="forgot-pass">Forgot Password?</a></span>
            </div>
            <input type="submit" value="Log In" class="btn btn-block  w-100 btn-color text-light">
           
          </form>
        </div>
      </div>
    </div>
  </div>
</div>