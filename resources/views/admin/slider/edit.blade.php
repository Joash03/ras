@extends('admin.admin_dashboard')

@section('admin')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">

      <!-- Header -->
      <div class="header">
        <div class="header-body">
          <div class="row align-items-center">
            <div class="col">
              <!-- Pretitle -->
              <h6 class="header-pretitle">Update</h6>
              <!-- Title -->
              <h1 class="header-title">Edit Slider</h1>
            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      <!-- Tab content -->
      <div class="tab-content">
        <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">

          <div class="card">
            <div class="card-body">

              <!-- Form -->
              <form class="mb-4" action="{{ route('slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Slider title -->
                        <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">
                            Slider Title
                          </label>
                          <!-- Input -->
                          <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Slider Photo -->
                        <div class="form-group" id="photoCreateContainer">
                          <!-- Label -->
                          <label class="form-label mb-1" for="photoEdit">File photo</label>
                          <!-- Input -->
                          <input class="form-control" type="file" id="photoEdit" name="photo" accept="image/*">
                          <!-- Image preview -->
                          <img src="{{ (!empty($slider->photo)) ? asset('uploads/slider_images/'.$slider->photo)
                          : asset('uploads/no_image.jpg') }}" alt="{{ $slider->name }}" id="showphotoEdit"
                          style="max-width: 30%; display: none;">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Slider subtitle -->
                        <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">
                            Slider Subtitle
                          </label>
                          <!-- Textarea -->
                          <textarea id="sub_title" name="sub_title" rows="5" class="form-control">{{ $slider->sub_title }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update slider
                </button>
              </form>

            </div>
          </div>
        </div>
      </div>

    </div>
  </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT -->

<script>
    $(document).ready(function () {
          $('#photoEdit').change(function (e) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#showphotoEdit').attr('src', e.target.result);
              }
              reader.readAsDataURL(e.target.files[0]);
          });

          // // Initially display "no_image.jpg"
          $('#showphotoEdit').css('display', 'block');
    });

function validateForm() {
    var title = document.getElementsByName('title')[0].value;
    var sub_title = document.getElementsByName('sub_title')[0].value;
    var photo = document.getElementsByName('photo')[0].value;

    // Validation checks
    if (title === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Title field is required!',
        });
        return false; // Prevent form submission
    }
    if (sub_title === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Sub Title field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
}


</script>

@endsection
