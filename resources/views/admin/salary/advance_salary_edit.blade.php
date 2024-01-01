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
                Edit Salary Details
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
              <form class="mb-4" action="{{ route('salary.advance.update', $advancesalary->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Employee name-->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Employee Name</label>
                      <!-- Input -->
                      <select id="employee_id" name="employee_id" class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                        @foreach ($employees as $item)
                            {
                                "value": "{{ $item->id }}",
                                "selected": "{{ $item->id == $advancesalary->employee_id ? 'selected' : '' }}",
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
                      <input type="number" class="form-control" id="year" name="year" value="{{ $advancesalary->year }}">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Salary month -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Month</label>
                      <!-- Input -->
                      <select class="form-select mb-3" data-choices name="month" id="month">
                        <option value="January" {{ $advancesalary->month == 'January' ? 'selected' : '' }}>January</option>
                        <option value="February"{{ $advancesalary->month == 'February' ? 'selected' : '' }}>February</option>
                        <option value="March"{{ $advancesalary->month == 'March' ? 'selected' : '' }}>March</option>
                        <option value="April"{{ $advancesalary->month == 'April' ? 'selected' : '' }}>April</option>
                        <option value="May"{{ $advancesalary->month == 'May' ? 'selected' : '' }}>May</option>
                        <option value="Jun"{{ $advancesalary->month == 'June' ? 'selected' : '' }}>June</option>
                        <option value="July"{{ $advancesalary->month == 'July' ? 'selected' : '' }}>July</option>
                        <option value="August"{{ $advancesalary->month == 'August' ? 'selected' : '' }}>August</option>
                        <option value="September"{{ $advancesalary->month == 'September' ? 'selected' : '' }}>September</option>
                        <option value="October"{{ $advancesalary->month == 'October' ? 'selected' : '' }}>October</option>
                        <option value="November"{{ $advancesalary->month == 'November' ? 'selected' : '' }}>November</option>
                        <option value="December"{{ $advancesalary->month == 'December' ? 'selected' : '' }}>December</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Salary -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1">Employee Salary</label>
                      <!-- Input -->
                      <input type="number" id="advance_salary" name="advance_salary" class="form-control mb-3" placeholder="#0.00" value="{{ $advancesalary->advance_salary }}">
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
