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
              <h1 class="header-title">Create New Role</h1>
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
              <form class="mb-4" action="{{ route('role.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Role name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Role Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Create Role
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
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // Initially display "no_image.jpg"
        $('#showphotoCreate').attr('src', '{{ asset('uploads/no_image.jpg') }}');
        $('#showphotoCreate').css('display', 'block');
  });

// Include SweetAlert library in your HTML

function validateForm() {
    var name = document.getElementsByName('name')[0].value;

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

    // If all checks pass, the form is valid
    return true;
}


</script>

@endsection
