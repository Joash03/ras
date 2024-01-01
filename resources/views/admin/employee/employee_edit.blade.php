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
                Edit Employee Details
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
              <form class="mb-4" action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Employee name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Employee Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Email address -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Employee Email</label>
                      <!-- Input -->
                      <input type="email" class="form-control"  id="email" name="email" value="{{ $employee->email }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Phone -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Employee Phone</label>
                      <!-- Input -->
                      <input type="text" class="form-control mb-3" placeholder="+234 ___-_______" data-inputmask='"mask": "+234 999 9999 999"' inputmode="text" id="phone" name="phone" value="{{ $employee->phone }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Address -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Address</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="address" name="address" value="{{ $employee->address }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Gender -->
                    <div class="form-group">
                        <!-- Label  -->
                        <label class="form-label">Gender</label>
                        <!-- Input -->
                        <select name="gender" id="gender" class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                            {
                                "value": "Male",
                                "selected": "{{ $employee->gender === 'Male' ? 'selected' : '' }}",
                                "label": "Male",
                                "customProperties": {
                                    "avatarSrc": "{{ url('backend/assets/img/masculine.png') }}"
                                }
                            },
                            {
                                "value": "Female",
                                "selected": "{{ $employee->gender === 'Female' ? 'selected' : '' }}",
                                "label": "Female",
                                "customProperties": {
                                    "avatarSrc": "{{ url('backend/assets/img/feminine.png') }}"
                                }
                            }
                        ]}'>
                        </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Date of Birth -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Date of Birth</label>
                        <!-- Input -->
                        <input type="date" name="dob" id="dob" class="form-control flatpickr-input" data-flatpickr="" value="{{ $employee->dob }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Religion -->
                      <div class="form-group">
                        <!-- Label  -->
                        <label class="form-label">Employee Religion</label>
                        <!-- Input -->
                        <select name="religion" id="religion" class="form-select mb-3"  data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                            {
                                "value": "Christianity",
                                "selected": "{{ $employee->religion === 'Christianity' ? 'selected' : '' }}",
                                "label": "Christianity",
                                "customProperties": {
                                    "avatarSrc": "{{ url('backend/assets/img/cross.png') }}"
                                }
                            },
                            {
                                "value": "Islam",
                                "selected": "{{ $employee->religion === 'Islam' ? 'selected' : '' }}",
                                "label": "Islam",
                                "customProperties": {
                                    "avatarSrc": "{{ url('backend/assets/img/moon.png') }}"
                                }
                            }
                        ]}'>
                        </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Next of Kin -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Next of Kin</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="next_kin" name="next_kin" value="{{ $employee->next_kin }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Blood Group -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Blood Group</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="blood_group" name="blood_group" value="{{ $employee->blood_group }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Qualification -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Qualification</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="qualification" name="qualification" value="{{ $employee->qualification }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Salary -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Salary</label>
                      <!-- Input -->
                      <input type="number" id="salary" name="salary" class="form-control mb-3" placeholder="#0.00" value="{{ $employee->salary }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Appointment date -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Appointment Date</label>
                        <!-- Input -->
                        <input type="date" name="appointment_date" id="appointment_date" class="form-control flatpickr-input" data-flatpickr="" value="{{ $employee->appointment_date }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Employee photo -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label mb-1" for="photoEdit">Employee Photo</label>
                      <!-- Input -->
                      <input class="form-control" type="file" id="photoEdit" name="photo" accept="image/*">
                      <!-- Image preview -->
                      <img src="{{ (!empty($employee->photo)) ? asset('uploads/employee_images/'.$employee->photo)
                      : asset('uploads/no_image.jpg') }}" alt="photo" id="showphotoEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Status Button toggle -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Employee Status</label>
                      <div class="btn-group-toggle">
                        <input type="radio" class="btn-check" name="status" id="statusa" value="active" {{ $employee->status == "active" ? 'checked':'' }} >
                        <label class="btn btn-white" for="statusa">
                          <i class="fe fe-check-circle"></i> Active
                        </label>
                        <input type="radio" class="btn-check" name="status" id="statusi" value="inactive" {{ $employee->status == "inactive" ? 'checked':'' }} >
                        <label class="btn btn-white" for="statusi">
                          <i class="fe fe-check-circle"></i> Inactive
                        </label>
                      </div>
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Update Employee Details
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
    var qualification = document.getElementsByName('qualification')[0].value;
    var salary = document.getElementsByName('salary')[0].value;
    var gender = document.getElementsByName('gender')[0].value;
    var dob = document.getElementsByName('dob')[0].value;
    var next_kin = document.getElementsByName('next_kin')[0].value;

    // Validation checks
    if (name === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee name is required!',
        });
        return false; // Prevent form submission
    }
    if (email === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee email is required!',
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
            text: 'Employee phone is required!',
        });
        return false; // Prevent form submission
    }
    if (address === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee address is required!',
        });
        return false; // Prevent form submission
    }
    if (qualification === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee qualification is required!',
        });
        return false; // Prevent form submission
    }
    if (gender === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee gender is required!',
        });
        return false; // Prevent form submission
    }
    if (qualification === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee qualification is required!',
        });
        return false; // Prevent form submission
    }
    if (dob === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee date of birth is required!',
        });
        return false; // Prevent form submission
    }
    if (next_kin === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee Next of Kin is required!',
        });
        return false; // Prevent form submission
    }
    if (salary === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Employee salary is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
  }



</script>

@endsection
