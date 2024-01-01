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
    <title>Sign up Page</title>
  </head>
  <body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

    <!-- CONTENT -->
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6 col-xl-5 px-lg-6 my-5 align-self-center">

          <!-- Heading -->
          <h1 class="display-4 text-center mb-3">
            Sign up
          </h1>

          <!-- Subheading -->
          <p class="text-muted text-center mb-5">
            Free access to our dashboard.
          </p>

          <!-- Form -->
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- First and Last Nam -->
            <div class="form-group">

              <!-- Label -->
              <label class="form-label">
                First and Last Nam
              </label>

              <!-- Input -->
              <input class="form-control" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />

            </div>

            <!-- Email Address -->
            <div class="form-group">

              <!-- Label -->
              <label class="form-label">
                Email Address
              </label>

              <!-- Input -->
              <input class="form-control" placeholder="name@address.com" id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />

            </div>

            <!-- Phone Number -->
            <div class="form-group">

                <!-- Label -->
                <label class="form-label">
                  Phone Number
                </label>

                <!-- Input -->
                <input class="form-control" id="phone" type="phone" name="phone" :value="old('phone')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />

            </div>

            <!-- Password -->
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <!-- Label -->
                  <label class="form-label"> Password</label>
                </div>
              </div> <!-- / .row -->

              <!-- Input group -->
              <div class="input-group input-group-merge">
                <!-- Input -->
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                @error('password')<span class="text-danger"> {{ $message }} </span>@enderror
                <!-- Icon -->
                <span class="input-group-text toggle-password">
                    <i class="fe fe-eye"></i>
                </span>
            </div>

            </div>

            <!-- Confirm Password -->
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <!-- Label -->
                  <label class="form-label">Confirm Password</label>
                </div>
              </div>

              <!-- Input group -->
              <div class="input-group input-group-merge">

                <!-- Input -->
                <input class="form-control" placeholder="Confirm password" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                <!-- Icon -->
                <span class="input-group-text confirm-toggle-password">
                  <i class="fe fe-eye"></i>
                </span>
              </div>
            </div>

            <!-- Submit -->
            <button class="btn btn-lg w-100 btn-primary mb-3" type="submit">
              Sign up
            </button>

            <!-- Link -->
            <div class="text-center">
              <small class="text-muted text-center">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>.
              </small>
            </div>

            <!-- Link -->
            <div class="text-center">
              <small class="text-muted text-center">
                <a href="{{ route('home') }}">Return to Website</a>.
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

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Toggle password visibility when the eye icon is clicked
            $('.toggle-password').click(function () {
                var passwordField = $('#password');
                var fieldType = passwordField.attr('type');

                // Toggle between 'password' and 'text'
                passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
                $(this).find('i').toggleClass('fe-eye fe-eye-off');
            });
        });

        $(document).ready(function () {
            // Toggle password visibility when the eye icon is clicked
            $('.confirm-toggle-password').click(function () {
                var passwordField = $('#password_confirmation');
                var fieldType = passwordField.attr('type');

                // Toggle between 'password' and 'text'
                passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
                $(this).find('i').toggleClass('fe-eye fe-eye-off');
            });
        });
    </script>

  </body>
</html>
