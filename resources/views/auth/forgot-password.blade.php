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
    <title>Forge Password Page</title>
  </head>
  <body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

    <!-- CONTENT -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6 col-xl-5 px-lg-6 my-5 align-self-center">

          <!-- Heading -->
          <h1 class="display-4 text-center mb-3">
            Forgot Password
          </h1>

          <!-- Subheading -->
          <p class="text-muted text-center mb-5">
            Enter your email to get a password reset link.
          </p>

          <!-- Form -->
          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email address -->
            <div class="form-group">

              <!-- Label -->
              <label class="form-label">
                Email Address
              </label>

              <!-- Input -->
              <input type="email" id="email" name="email" class="form-control" placeholder="name@address.com" :value="old('email')" required autofocus />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <!-- Submit -->
            <button class="btn btn-lg w-100 btn-primary mb-3" type="submit">
              Reset Password
            </button>

            <!-- Link -->
            <div class="text-center">
              <small class="text-muted text-center">
                Remember your password? <a href="{{ route('login') }}">Sign in</a>.
              </small>
            </div>

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
