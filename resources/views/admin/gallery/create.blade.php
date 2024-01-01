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
              <h6 class="header-pretitle">New</h6>
              <!-- Title -->
              <h1 class="header-title">Create a new Gallery</h1>
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
              <form class="mb-4" action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">

                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Gallery name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">
                                File Caption
                            </label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="caption" name="caption">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Status Button toggle -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Choose File Type</label>
                        <div class="form-group btn-group-toggle">
                            <input type="radio" class="btn-check" name="type" id="photog" value="0" checked>
                            <label class="btn btn-white" for="photog">
                                <i class="fe fe-check-circle"></i> Photo
                            </label>
                            <input type="radio" class="btn-check" name="type" id="videog" value="1">
                            <label class="btn btn-white" for="videog">
                                <i class="fe fe-check-circle"></i> Video
                            </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Gallery Photo -->
                        <div class="form-group" id="photoCreateContainer">
                            <!-- Label -->
                            <label class="form-label mb-1" for="photoCreate">Photo</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="photoCreate" name="photo" accept="image/*">
                            <!-- Image preview -->
                            <img src="{{ asset('uploads/no_image.jpg') }}" alt="photo" id="showphotoCreate" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                </div> <!-- / .row -->

                <!-- Video Link -->
                <div class="row" id="videoCreateContainer">
                    <div class="col-12 col-md-6">
                        <!--  Video Link -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label"> Video Link</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="video_link" name="video_link">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Gallery Photo -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1" for="photoCreateVideo">Photo</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="photoCreateVideo" name="vphoto" accept="image/*">
                            <!-- Image preview -->
                            <img src="{{ asset('uploads/no_image.jpg') }}" alt="photo" id="showphotoCreateVideo" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Create Gallery
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
    $('#photoCreate').change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#showphotoCreate').attr('src', e.target.result);
            $('#showphotoCreate').css('display', 'block'); // Display the image preview
        }
        reader.readAsDataURL(e.target.files[0]);
    });

    // Initially display "no_image.jpg"
    $('#showphotoCreate').attr('src', '{{ asset('uploads/no_image.jpg') }}');
    $('#showphotoCreate').css('display', 'none'); // Hide the image preview initially
});

  $(document).ready(function () {
        $('#photoCreateVideo').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showphotoCreateVideo').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // Initially display "no_image.jpg"
        $('#showphotoCreateVideo').attr('src', '{{ asset('uploads/no_image.jpg') }}');
        $('#showphotoCreateVideo').css('display', 'block');
  });

  function toggleFields() {
    var photoRadio = document.getElementById("photog");
    var videoRadio = document.getElementById("videog");
    var photoField = document.getElementById("photoCreateContainer");
    var videoField = document.getElementById("videoCreateContainer");

    // Check which radio button is selected
    if (photoRadio.checked) {
        photoField.style.display = "block";
        videoField.style.display = "none";
        videoField.removeAttribute("required"); // Remove the "required" attribute
    } else if (videoRadio.checked) {
        photoField.style.display = "none";
        videoField.style.display = "block";
        videoField.setAttribute("required", "true"); // Add the "required" attribute
    }
  }

  // Call the function when the page loads to set the initial state
  window.addEventListener("load", toggleFields);

  // Attach an event listener to the radio buttons to toggle fields on click
  var radioButtons = document.querySelectorAll('input[name="type"]');
  radioButtons.forEach(function (radioButton) {
      radioButton.addEventListener("change", toggleFields); // Change to "change" event
  });


  // Form validation
  function validateForm() {
        // Get form inputs
        var caption = document.getElementById('caption').value;
        var photoRadio = document.getElementById('photog');
        var videoRadio = document.getElementById('videog');
        var photo = document.getElementById('photoCreate').value;
        var photoVideo = document.getElementById('photoCreateVideo').value;
        var videoLink = document.getElementById('video_link').value;

        // Check if the "Photo" radio is selected and validate accordingly
        if (photoRadio.checked) {
            if (caption === '' || !photo) {
                // Show a SweetAlert error message for Photo
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields for Photo!',
                });

                // Prevent form submission
                return false;
            }
        }

        // Check if the "Video" radio is selected and validate accordingly
        if (videoRadio.checked) {
            if (caption === '' || videoLink === '' || !photoVideo) {
                // Show a SweetAlert error message for Video
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields for Video!',
                });

                // Prevent form submission
                return false;
            }
        }

        // If all fields are filled, allow form submission
        return true;
  }

</script>

@endsection
