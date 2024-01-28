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
              <h1 class="header-title">Create New Permission</h1>
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
              <form class="mb-4" action="{{ route('permission.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Permission name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Permission Name</label>
                      <!-- Input -->
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Permission name -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Group Name</label>
                      <!-- Input -->
                      <select name="group_name" id="group_name" class="form-select mb-3" data-choices='{"searchEnabled": false, "choices": [
                        {
                          "value": "attendance",
                          "label": "&emsp;Attendance",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "blog",
                          "label": "&emsp;Blog",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "category",
                          "label": "&emsp;Category",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "customers",
                          "label": "&emsp;Customers",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "employees",
                          "label": "&emsp;Employees",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "employee_roles",
                          "label": "&emsp;Employee Roles",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "expenses",
                          "label": "&emsp;Expenses",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "gallery",
                          "label": "&emsp;Gallery",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "general_settings",
                          "label": "&emsp;General Settings",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "menu",
                          "label": "&emsp;Menu",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "order",
                          "label": "&emsp;Order",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "pos",
                          "label": "&emsp;POS",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "product",
                          "label": "&emsp;Product",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "product_inventory",
                          "label": "&emsp;Product Inventory",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "reservations",
                          "label": "&emsp;Reservations",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "roles",
                          "label": "&emsp;Roles",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "salaries",
                          "label": "&emsp;Salaries",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "services",
                          "label": "&emsp;Services",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "slider",
                          "label": "&emsp;Slider",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "store_inventory",
                          "label": "&emsp;Store Inventory",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "suppliers",
                          "label": "&emsp;Suppliers",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "team",
                          "label": "&emsp;Team",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        },
                        {
                          "value": "testimonial",
                          "label": "&emsp;Testimonial",
                          "customProperties": {
                            "avatarSrc": ""
                          }
                        }
                      ]}'></select>
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Create Permission
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
    var name = document.getElementsByName('name')[0].value;
    var groupName = document.getElementsByName('group_name')[0].value;

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

    if (groupName === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Group Name field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
}


</script>

@endsection
