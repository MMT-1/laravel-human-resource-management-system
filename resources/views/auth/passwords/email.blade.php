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
@section('title') reset password @endsection


<div class="d-lg-flex half">
  <div class="bg order-1 order-md-2" style="background-image: url('{{asset('front/assets/images/1682747491.jpg')}}');">
  </div>
  <div class="contents order-2 order-md-1">


            <div class="container ">
            <div class="row align-items-center justify-content-center">
        <div class="col-md-6">

                <!-- Account Logo -->
                {{-- message --}}
                {!! Toastr::message() !!}
                <!-- /Account Logo -->
                <div class="account-box ">
                    <div class="account-wrapper">
                        <h3 class="account-title">Forgot Password</h3>
                        <p class="account-subtitle">Input your email send you a reset password link.</p>
                        <!-- Account Form -->
                        <form method="POST" action="/forget-password">
                            @csrf
                            <div class="form-group last mb-3 mt-3">
                                <label>Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="submit" value="Send" class="btn btn-block  w-100 btn-color text-light">

                            <div class="text-center mt-3">
                                <span>Don't have an account yet? <a href="{{ route('login') }}">Login</a></span>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
                </div>

    </div>
 </div>
    </div>
  </div>
</div>