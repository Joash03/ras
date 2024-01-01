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
    <title>Error 403</title>
  </head>
  <body class="d-flex align-items-center bg-auth border-top border-top-2 border-primary">

    <!-- CONTENT -->
    {{-- <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-6 col-xl-5 px-lg-6 my-5 align-self-center">

          <div class="text-center">

            <!-- Preheading -->
            <h6 class="text-uppercase text-muted mb-4">
              403 error
            </h6>

            <!-- Heading -->
            <h1 class="display-4 mb-3">
                Invalid Permission 😭
            </h1>

            <!-- Subheading -->
            <p class="text-muted mb-4">
              Looks like you ended up here by accident?
            </p>

            <!-- Button -->
            <a href="#" class="btn btn-lg btn-primary" onclick="return goBack();">
              Return Back
            </a>

          </div>

        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xl-7 d-none d-lg-block">

          <!-- Image -->
          <div class="bg-cover h-100 min-vh-100 mt-n1 me-n3" style="background-image: url({{ ('backend/assets/img/covers/04.jpg') }});"> <img src="{{ ('backend/assets/img/covers/04.jpg') }}" alt="..."></div>

        </div>
      </div> <!-- / .row -->
    </div> --}}
    <div class="container -fluid">
        <div class="row justify-content-center">
          <div class="col-12 col-md-5 col-xl-4 my-5">

            <div class="text-center">

              <!-- Preheading -->
              <h4 class="text-uppercase text-muted mb-4">
                419 Error
              </h4>

              <!-- Heading -->
              <h1 class="display-4 mb-3">
                Page Expired 😭
              </h1>

              <!-- Subheading -->
              <p class="text-muted mb-4">
                Looks like you took a long break?
              </p>

              <!-- Button -->
              <a class="btn btn-lg btn-primary" href="{{ route('home') }}">
                Refresh Session
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

