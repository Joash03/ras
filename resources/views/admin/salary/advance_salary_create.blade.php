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
              <h1 class="header-title">Create Adavance Salary</h1>
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
              <form class="mb-4" action="{{ route('salary.advance.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!--Selete employee -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Selete Employee</label>
                      <!-- Input -->
                      <select id="employee_id" name="employee_id" class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                          @foreach ($employees as $item)
                          {
                              "value": "{{ $item->id }}",
                              "label": "{{ $item->name }}",
                              "customProperties": {
                                  "avatarSrc": "{{ (!empty($item->photo)) ? url('uploads/employee_images/'.$item->photo) : url('uploads/no_image.jpg') }}"
                              }
                          }
                          @if (!$loop->last),
                          @endif
                          @endforeach
                      ]}'>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Year -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Year</label>
                      <!-- Input -->
                      <input type="number" class="form-control" id="year" name="year" value="{{ date('Y') }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Salary month -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Month</label>
                      <!-- Input -->
                      <select class="form-select mb-3" data-choices name="month" id="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Salary -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Employee Advance Salary</label>
                      <!-- Input -->
                      <input type="number" id="advance_salary" name="advance_salary" class="form-control mb-3" placeholder="#0.00" >
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                 Pay Advance Salary
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

  function validateForm() {
    var month = document.getElementsByName('month')[0].value;
    var year = document.getElementsByName('year')[0].value;
    var advanceSalary = document.getElementsByName('advance_salary')[0].value;

    // Validation checks
    if (month === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Month field is required!',
        });
        return false; // Prevent form submission
    }

    if (year === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Year field is required!',
        });
        return false; // Prevent form submission
    }

    if (advanceSalary === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Advance Salary field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
}

</script>

@endsection
