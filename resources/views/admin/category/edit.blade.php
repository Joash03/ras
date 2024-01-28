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
                Update
              </h6>

              <!-- Title -->
              <h1 class="header-title">
                Edit Category
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
              <form class="mb-4" action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Category name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Category Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name"  value="{{ $category->name }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Status Button toggle -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Category Type</label>
                      <div class="btn-group-toggle">
                        <input type="radio" class="btn-check" name="type" id="menuc" value="0" {{ $category->type == 0 ? 'checked':'' }}>
                        <label class="btn btn-white" for="menuc">
                          <i class="fe fe-check-circle"></i> Menu
                        </label>

                        <input type="radio" class="btn-check" name="type" id="productc" value="1" {{ $category->type == 1 ? 'checked':'' }}>
                        <label class="btn btn-white" for="productc">
                          <i class="fe fe-check-circle"></i> Product
                        </label>

                        <input type="radio" class="btn-check" name="type" id="blogc" value="2" {{ $category->type == 2 ? 'checked':'' }}>
                        <label class="btn btn-white" for="blogc">
                          <i class="fe fe-check-circle"></i> Blog
                        </label>

                        <input type="radio" class="btn-check" name="type" id="storec" value="3" {{ $category->type == 3 ? 'checked':'' }}>
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
                      <input class="form-control" type="file" id="thumbnailEdit" name="thumbnail" accept="image/*">
                      <!-- Image preview -->
                      <img class="avatar-img rounded" src="{{ (!empty($category->thumbnail)) ? asset('uploads/category_images/'.$category->thumbnail) : asset('uploads/no_image.jpg') }}" alt="{{ $category->name }}" id="showThumbnailEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Update Category
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
