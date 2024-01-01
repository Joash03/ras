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
              <h1 class="header-title">Edit Service</h1>
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
              <form class="mb-4" action="{{ route('service.update', $service->id) }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Service name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Service Name</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="name" name="name"  value="{{ $service->name }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Service description -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1"> Service description </label>
                            <!-- Text -->
                            <small class="form-text text-muted">This is how customers will learn about this service, so make it good!</small>
                            <!-- Textarea -->
                            <textarea name="description" class="form-control" >{{ $service->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Service cover -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1" for="thumbnailEdit">Service Thumbnail</label>
                            <!-- Input -->
                            <input class="form-control" type="file" id="thumbnailEdit" name="thumbnail" accept="image/*">
                            <!-- Image preview -->
                            <img class="avatar-img rounded" src="{{ (!empty($service->thumbnail)) ? asset('uploads/service_images/'.$service->thumbnail)
                                      : asset('uploads/no_image.jpg') }}" alt="{{ $service->name }}" id="showThumbnailEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Status Button toggle -->
                      <!-- Status Button toggle -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Category Type</label>
                        <div class="btn-group-toggle">
                            <input type="radio" class="btn-check" name="status" id="publish" value="1" {{ $service->status == 1 ? 'checked':'' }}>
                            <label class="btn btn-white" for="publish">
                                <i class="fe fe-check-circle"></i> Publish service
                            </label>

                            <input type="radio" class="btn-check" name="status" id="draft" value="0" {{ $service->status == 0 ? 'checked':'' }}>
                            <label class="btn btn-white" for="draft">
                                <i class="fe fe-check-circle"></i> Save to Draft
                            </label>
                        </div>
                      </div>
                    </div>
                </div>


                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update Service
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
    var description = document.getElementsByName('description')[0].value;
    var status = document.getElementsByName('status')[0].value;

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
    // Add additional checks for the 'thumbnail' field if needed

    if (description === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Description field is required!',
        });
        return false; // Prevent form submission
    }
    if (status === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Status field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
  }


</script>

@endsection
