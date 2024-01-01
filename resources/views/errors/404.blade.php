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
    <title>Error 404</title>
  </head>
  <body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

    <!-- CONTENT -->
    <div class="container -fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-md-5 col-xl-4 my-5">

            <div class="text-center">

              <!-- Preheading -->
              <h4 class="text-uppercase text-muted mb-4">
                404 error
              </h4>

              <!-- Heading -->
              <h1 class="display-4 mb-3">
                No page here 😭
              </h1>

              <!-- Subheading -->
              <p class="text-muted mb-4">
                Looks like you ended up here by accident?
              </p>

              <!-- Button -->
              <a class="btn btn-lg btn-primary" href="{{ route('home') }}">
                Return Home
              </a>

            </div>

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

