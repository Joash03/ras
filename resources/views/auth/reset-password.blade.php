<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />

    @php
        $general = \App\Models\General::latest('created_at')->first();
    @endphp

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}" type="image/x-icon"/>

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/theme.bundle.css') }}" />

    <!-- Title -->
    <title>Reset Password Page</title>
  </head>
  <body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

    <!-- CONTENT -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6 col-xl-5 px-lg-6 my-5 align-self-center">

          <!-- Heading -->
          <h1 class="display-4 text-center mb-3">
            Reset Password
          </h1>

          <!-- Subheading -->
          <p class="text-muted text-center mb-5">
            You can reset your password here
          </p>

          <!-- Form -->
          <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email/Name/Phone -->
            <div class="form-group">
              <!-- Label -->
              <label for="email" class="form-label">Email</label>
              <!-- Input -->
              <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" id="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
              @error('email') <span class="text-danger"> {{ $message }} </span>@enderror
            </div>

            <!-- New password -->
            <div class="form-group">

              <!-- Label -->
              <label class="form-label">New password</label>
              <!-- Input -->
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
              @error('password')
              <span class="text-danger"> {{ $message }} </span>
              @enderror

            </div>

            <!-- Confirm new password -->
            <div class="form-group">

              <!-- Label -->
              <label class="form-label">Confirm new password</label>
              <!-- Input -->
              <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" >

            </div>


            <!-- Submit -->
            <button class="btn btn-lg w-100 btn-primary mb-3" type="submit">
              Reset Password
            </button>

            <!-- Link -->
            <p class="text-center">
              <small class="text-muted text-center">
                Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>.
              </small>
            </p>

          </form>

        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-7 d-none d-lg-block">

          <!-- Image -->
          <div class="bg-cover h-100 min-vh-100 mt-n1 me-n3" style="background-image: url({{ ('backend/assets/img/covers/04.jpg') }});"></div>

        </div>
      </div> <!-- / .row -->
    </div>

    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('backend/assets/js/theme.bundle.js') }}"></script>

  </body>
</html>

