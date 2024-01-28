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
              <h6 class="header-pretitle">
                New
              </h6>

              <!-- Title -->
              <h1 class="header-title">
                Create a new Testimonial
              </h1>

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
              <form class="mb-4" action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Testimonial name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Testimonial Name</label>
                            <!-- Input -->
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Testimonial Message -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1">Testimonial Message</label>
                            <!-- Text -->
                            <small class="form-text text-muted">This is how customers will learn about this restaurant, so make it good! </small>
                            <!-- Textarea -->
                            <textarea name="message" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Testimonial thumbnail -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1" for="thumbnailCreate">Testimonial Thumbnail</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="thumbnailCreate" name="photo" accept="image/*">
                            <!-- Image preview -->
                            <img src="{{ asset('uploads/no_image.jpg') }}" alt="thumbnail" id="showThumbnailCreate" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                </div>


                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Create Testimonial
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
        $('#thumbnailCreate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailCreate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
        // Initially display "no_image.jpg"
        $('#showThumbnailCreate').attr('src', '{{ asset('uploads/no_image.jpg') }}');
        $('#showThumbnailCreate').css('display', 'block');
  });



function validateForm() {
    var name = document.getElementsByName('name')[0].value;
    var thumbnail = document.getElementsByName('thumbnail')[0].value;
    var designation = document.getElementsByName('designation')[0].value;

    // Validation checks
    if (name === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Name field is required!',
        });
        return false; // Prevent form submission
    }

    if (thumbnail === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Thumbnail field is required!',
        });
        return false; // Prevent form submission
    }

    // Validate thumbnail file extension
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(thumbnail)) {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please upload a valid image file (JPEG, JPG, PNG)!',
        });
        return false; // Prevent form submission
    }

    if (designation === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Designation field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
}

</script>

@endsection
