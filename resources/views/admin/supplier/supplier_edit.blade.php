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
                Edit Supplier Details
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
              <form class="mb-4" action="{{ route('supplier.update', $supplier->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Supplier name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Supplier Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name" value="{{ $supplier->name }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Email address -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Supplier Email</label>
                      <!-- Input -->
                      <input type="email" class="form-control"  id="email" name="email" value="{{ $supplier->email }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Phone -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Supplier Phone</label>
                      <!-- Input -->
                      <input type="text" class="form-control mb-3" placeholder="+234 ___-_______" data-inputmask='"mask": "+234 999 9999 999"' inputmode="text" id="phone" name="phone" value="{{ $supplier->phone }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Address -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Supplier Address</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="address" name="address" value="{{ $supplier->address }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Supplier photo -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label mb-1" for="photoEdit">Supplier Photo</label>
                      <!-- Input -->
                      <input class="form-control" type="file" id="photoEdit" name="photo" accept="image/*">
                      <!-- Image preview -->
                      <img src="{{ (!empty($supplier->photo)) ? asset('uploads/supplier_images/'.$supplier->photo)
                      : asset('uploads/no_image.jpg') }}" alt="photo" id="showphotoEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Type Button toggle -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Supplier Type</label>
                      <div class="btn-group-toggle">
                        <input type="radio" class="btn-check" name="type" id="typea" value="wholesaler" {{ $supplier->type == "wholesaler" ? 'checked':'' }} >
                        <label class="btn btn-white" for="typea">
                          <i class="fe fe-check-circle"></i> Wholesaler
                        </label>
                        <input type="radio" class="btn-check" name="type" id="typei" value="distributor" {{ $supplier->type == "distributor" ? 'checked':'' }} >
                        <label class="btn btn-white" for="typei">
                          <i class="fe fe-check-circle"></i> Distributor
                        </label>
                      </div>
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Update Supplier Details
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
    var name = document.getElementsByName('name')[0].value;
    var email = document.getElementsByName('email')[0].value;
    var phone = document.getElementsByName('phone')[0].value;
    var address = document.getElementsByName('address')[0].value;

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

    if (email === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Email field is required!',
        });
        return false; // Prevent form submission
    }
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    if (!email.match(emailPattern)) {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter a valid email address!',
        });
        return false; // Prevent form submission
    }

    if (phone === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Phone field is required!',
        });
        return false; // Prevent form submission
    }

    if (address === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Address field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
  }

</script>

@endsection
