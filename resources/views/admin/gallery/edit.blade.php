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
              <h1 class="header-title"> Edit Gallery</h1>
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
              <form class="mb-4" action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
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
                            <input type="text" class="form-control" id="caption" name="caption" value="{{ $gallery->caption }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Status Button toggle -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Choose File Type</label>
                        <div class="form-group btn-group-toggle">
                            <input type="radio" class="btn-check" name="type" id="photog" value="0" {{ $gallery->type == 0 ? 'checked':'' }}>
                            <label class="btn btn-white" for="photog">
                                <i class="fe fe-check-circle"></i> Photo
                            </label>

                            <input type="radio" class="btn-check" name="type" id="videog" value="1" {{ $gallery->type == 1 ? 'checked':'' }}>
                            <label class="btn btn-white" for="videog">
                                <i class="fe fe-check-circle"></i> Video
                            </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Gallery Photo -->
                        <div class="form-group" id="photoEditContainer">
                            <!-- Label -->
                            <label class="form-label mb-1" for="photoEdit">File photo</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="photoEdit" name="photo" accept="image/*">
                            <!-- Image preview -->
                            <img src="{{ (!empty($gallery->photo)) ? asset('uploads/gallery_images/'.$gallery->photo) : asset('uploads/no_image.jpg') }}" alt="{{ $gallery->name }}" id="showphotoEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                    <!-- Video Link -->
                    <div class="form-group {{ $gallery->type == 0 ? 'd-none':'' }}" id="videoEditContainer">
                        <div class="col-12 col-md-6">
                            <!--  Video Link -->
                            <div class="form-group">
                                <!-- Label -->
                                <label class="form-label"> Video Link</label>
                                <!-- Input -->
                                <input type="text" class="form-control" id="video_link" name="video_link" value="{{ $gallery->video_link }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <!-- Gallery Photo -->
                            <div class="form-group">
                                <!-- Label -->
                                <label class="form-label mb-1" for="photoEditVideo">Photo</label>
                                <!-- Input -->
                                <input class="form-control" type="file" id="photoEditVideo" name="vphoto" accept="image/*">
                                <!-- Image preview -->
                                <img src="{{ (!empty($gallery->photo)) ? asset('uploads/gallery_images/'.$gallery->photo) : asset('uploads/no_image.jpg') }}" alt="{{ $gallery->name }}" id="showphotoEditVideo" style="max-width: 15%; padding-top: 10px; display: none;">
                            </div>
                        </div>
                    </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update Gallery
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

    $(document).ready(function () {
          $('#photoEditVideo').change(function (e) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#showphotoEditVideo').attr('src', e.target.result);
              }
              reader.readAsDataURL(e.target.files[0]);
          });

          // // Initially display "no_image.jpg"
          $('#showphotoEditVideo').css('display', 'block');
    });

    function toggleFields() {
    var photoRadio = document.getElementById("photog");
    var videoRadio = document.getElementById("videog");
    var photoField = document.getElementById("photoEditContainer");
    var videoField = document.getElementById("videoEditContainer");

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



  function validateForm() {
        // Get form inputs
        var caption = document.getElementById('caption').value;
        var photoRadio = document.getElementById('photog');
        var videoRadio = document.getElementById('videog');
        var photo = document.getElementById('photoEdit').value;
        var videoLink = document.getElementById('video_link').value;

        // Check if the "Photo" radio is selected and validate accordingly
        if (photoRadio.checked) {
            if (caption === '') {
                // Show a SweetAlert error message for Photo
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields!',
                });

                // Prevent form submission
                return false;
            }
        }

        // Check if the "Video" radio is selected and validate accordingly
        if (videoRadio.checked) {
            if (caption === '' || videoLink === '') {
                // Show a SweetAlert error message for Video
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all required fields!',
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
