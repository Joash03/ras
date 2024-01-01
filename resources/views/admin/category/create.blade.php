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
              <h1 class="header-title">Create New Category</h1>
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
              <form class="mb-4" action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Category name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Category Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Status Button toggle -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Category Type</label>
                      <div class="btn-group-toggle">
                        <input type="radio" class="btn-check" name="type" id="menuc" value="0" checked="">
                        <label class="btn btn-white" for="menuc">
                          <i class="fe fe-check-circle"></i> Menu
                        </label>

                        <input type="radio" class="btn-check" name="type" id="productc" value="1">
                        <label class="btn btn-white" for="productc">
                          <i class="fe fe-check-circle"></i> Product
                        </label>

                        <input type="radio" class="btn-check" name="type" id="blogc" value="2">
                        <label class="btn btn-white" for="blogc">
                          <i class="fe fe-check-circle"></i> Blog
                        </label>

                        <input type="radio" class="btn-check" name="type" id="storec" value="3">
                        <label class="btn btn-white" for="storec">
                          <i class="fe fe-check-circle"></i> Store
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                     <!-- Category cover -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1" for="thumbnailCreate">Category Thumbnail</label>
                      <!-- Input -->
                      <input class="form-control" type="file" id="thumbnailCreate" name="thumbnail" accept="image/*">
                      <!-- Image preview -->
                      <img src="{{ asset('uploads/no_image.jpg') }}" alt="thumbnail" id="showThumbnailCreate" style="max-width: 15%; padding-top: 10px; display: none;">
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Create Category
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

  // Function to validate the form
  function validateForm() {
        var name = document.getElementById('name').value;

        // Check if the name field is empty
        if (name === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Name field is required!',
            });
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

@endsection

