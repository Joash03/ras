@extends('admin.admin_dashboard')

@section('admin')

<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>

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
              <h1 class="header-title">Create Role Permissions</h1>
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
              <form class="mb-4" action="{{ route('admin.employee.role.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Employee -->
                        <div class="form-group">
                            <!-- Label  -->
                            <label class="form-label">All Employee</label>
                            <!-- Input -->
                            <select name="employee_id" id="employee_id"  class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                                @foreach ($users as $item)
                                {
                                    "value": "{{ $item->id }}",
                                    "selected": "{{ $item->id == '1' ? 'selected' : '' }}",
                                    "label": "{{ $item->name }}",
                                    "customProperties": {
                                        "avatarSrc": "{{ (!empty($item->photo)) ? url('uploads/'.($item->role == 'admin' ? 'admin_images/' : 'employee_images/').$item->photo) : url('uploads/no_image.jpg') }}"
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
                    <!-- Role -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label"> Roles </label>
                      <!-- Input -->
                      <select name="role_id" id="role_id"  class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                        @foreach ($roles as $item)
                        {
                            "value": "{{ $item->id }}",
                            "label": "&emsp;{{ $item->name }}",
                            "customProperties": {
                                "avatarSrc": ""
                            }
                        }
                        @if (!$loop->last),
                        @endif
                        @endforeach
                      ]}'></select>
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                  Assign Role to Employee
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

<script type="text/javascript">
    $('#checkprermission').click(function(){
        if ($(this).is(':checked')) {
            $('input[type = checkbox]').prop('checked',true);
        }else{
            $('input[type = checkbox]').prop('checked',false);
        }

    });
</script>

@endsection
