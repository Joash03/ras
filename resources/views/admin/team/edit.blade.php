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
              <h1 class="header-title">Edit Team</h1>
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
              <form class="mb-4" action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf


                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Team name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Team Name</label>
                            <!-- Input -->
                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Team name -->
                        <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">Team Designation</label>
                          <!-- Input -->
                          <input type="text" class="form-control" name="designation" value="{{ $team->designation }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Team cover -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1" for="thumbnailEdit">Team Thumbnail</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="thumbnailEdit" name="thumbnail" accept="image/*">
                            <!-- Image preview -->
                            <img class="avatar-img rounded" src="{{ (!empty($team->thumbnail)) ? asset('uploads/team_images/'.$team->thumbnail) : asset('uploads/no_image.jpg') }}" alt="{{ $team->name }}" id="showThumbnailEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update Team
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
        $('#thumbnailEdit').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailEdit').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // // Initially display "no_image.jpg"
        $('#showThumbnailEdit').css('display', 'block');
  });



function validateForm() {
    var name = document.getElementsByName('name')[0].value;
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
