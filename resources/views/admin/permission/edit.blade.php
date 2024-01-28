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
                Edit Permission Details
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
              <form class="mb-4" action="{{ route('permission.update', $permission->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">

                    <div class="col-12 col-md-6">
                        <!-- Permission name -->
                        <div class="form-group">
                          <!-- Label  -->
                          <label class="form-label">Permission Name</label>
                          <!-- Input -->
                          <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
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
                              "selected": "{{ $permission->group_name == 'attendance' ? 'selected' : '' }}",
                              "label": "&emsp;Attendance",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "blog",
                              "selected": "{{ $permission->group_name == 'blog' ? 'selected' : '' }}",
                              "label": "&emsp;Blog",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "category",
                              "selected": "{{ $permission->group_name == 'category' ? 'selected' : '' }}",
                              "label": "&emsp;Category",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "customers",
                              "selected": "{{ $permission->group_name == 'customers' ? 'selected' : '' }}",
                              "label": "&emsp;Customers",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "employees",
                              "selected": "{{ $permission->group_name == 'employees' ? 'selected' : '' }}",
                              "label": "&emsp;Employees",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "employee_roles",
                              "selected": "{{ $permission->group_name == 'employee_roles' ? 'selected' : '' }}",
                              "label": "&emsp;Employees Roles",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "expenses",
                              "selected": "{{ $permission->group_name == 'expenses' ? 'selected' : '' }}",
                              "label": "&emsp;Expenses",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "gallery",
                              "selected": "{{ $permission->group_name == 'gallery' ? 'selected' : '' }}",
                              "label": "&emsp;Gallery",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "general_settings",
                              "selected": "{{ $permission->group_name == 'general_settings' ? 'selected' : '' }}",
                              "label": "&emsp;General Settings",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "menu",
                              "selected": "{{ $permission->group_name == 'menu' ? 'selected' : '' }}",
                              "label": "&emsp;Menu",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "order",
                              "selected": "{{ $permission->group_name == 'order' ? 'selected' : '' }}",
                              "label": "&emsp;Order",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "permissions",
                              "selected": "{{ $permission->group_name == 'permissions' ? 'selected' : '' }}",
                              "label": "&emsp;Permissions",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "pos",
                              "selected": "{{ $permission->group_name == 'pos' ? 'selected' : '' }}",
                              "label": "&emsp;POS",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "product",
                              "selected": "{{ $permission->group_name == 'product' ? 'selected' : '' }}",
                              "label": "&emsp;Product",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "product_inventory",
                              "selected": "{{ $permission->group_name == 'product_inventory' ? 'selected' : '' }}",
                              "label": "&emsp;Product Inventory",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "reservations",
                              "selected": "{{ $permission->group_name == 'reservations' ? 'selected' : '' }}",
                              "label": "&emsp;Reservations",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "roles",
                              "selected": "{{ $permission->group_name == 'roles' ? 'selected' : '' }}",
                              "label": "&emsp;Roles",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "salaries",
                              "selected": "{{ $permission->group_name == 'salaries' ? 'selected' : '' }}",
                              "label": "&emsp;Salaries",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "services",
                              "selected": "{{ $permission->group_name == 'services' ? 'selected' : '' }}",
                              "label": "&emsp;Services",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "slider",
                              "selected": "{{ $permission->group_name == 'slider' ? 'selected' : '' }}",
                              "label": "&emsp;Slider",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "store_inventory",
                              "selected": "{{ $permission->group_name == 'store_inventory' ? 'selected' : '' }}",
                              "label": "&emsp;Store Inventory",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "suppliers",
                              "selected": "{{ $permission->group_name == 'suppliers' ? 'selected' : '' }}",
                              "label": "&emsp;Suppliers",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "team",
                              "selected": "{{ $permission->group_name == 'team' ? 'selected' : '' }}",
                              "label": "&emsp;Team",
                              "customProperties": {
                                "avatarSrc": ""
                              }
                            },
                            {
                              "value": "testimonial",
                              "selected": "{{ $permission->group_name == 'testimonial' ? 'selected' : '' }}",
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
                  Update Permission Details
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
