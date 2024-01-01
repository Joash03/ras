<!DOCTYPE html>
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

     <!-- Include jQuery library -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

     <!-- Sweetalert included -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Tinym included -->
    <script src="https://cdn.tiny.cloud/1/ad5t23ciraevddrpjlg1gzqd3d29i7n79549ob6aa3cxmqq6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Title -->
    <title>RAS Admin Dashboard</title>
  </head>
  <body>
    <!-- Scroll Bar Style -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <style>
        ::-webkit-scrollbar {
           width: 8px;
           height: 8px;
        }
        ::-webkit-scrollbar-thumb {
          border-radius: 30px;
          background: -webkit-gradient(linear,left top,left bottom,from(#e6e6e6),to(#cacaca));
          }
        ::-webkit-scrollbar-track {
          background-color: #fff;
          border-radius:8px;
        }
    </style>

    <!-- NAVIGATION -->
    @include('admin.body.navbar')

    <!-- Sweetalert included -->
    @include('sweetalert::alert')

    <!-- MAIN CONTENT -->
    <div class="main-content">

      <!-- CARDS -->
        @yield('admin')

    </div><!-- / .main-content -->

    <!-- JAVASCRIPT -->
    <script>
      tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
      });
    </script>
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('backend/assets/js/theme.bundle.js') }}"></script>

     <!-- Sweetalert included -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  </body>
</html>
