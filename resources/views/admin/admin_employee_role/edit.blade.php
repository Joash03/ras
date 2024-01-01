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
                Edit Role Permissions
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

              <!-- Form -->
              <form class="mb-4" action="{{ route('admin.employee.role.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Role -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label"> Employee Name </label>
                      <h4 class="form-control">{{ $user->name }}</h4>
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
                            "selected": "{{ $user->hasRole($item->name) ? 'selected' : '' }}",
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
                    Update Role Permissions
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
