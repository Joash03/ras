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
              <form class="mb-4" action="{{ route('role.permission.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Permission -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label"> Permissions </label>
                      <!-- Input -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="checkprermission">
                            <label class="form-check-label">All Permissions</label>
                        </div><br>
                        @foreach($permission_groups as $group)
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkgroup">
                                <label class="form-check-label">{{ $group->group_name }}</label>
                                </div>
                            </div>
                            @php
                            $permissions = App\Models\User::getpermissionByGroupName($group->group_name);
                            @endphp

                            <div class="col-12 col-md-6">
                            @foreach($permissions as $permission)
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="checkgrouplist{{ $permission->id }}">
                                <label class="form-check-label"for="customckeck{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                            @endforeach
                            </div>
                        </div><br>
                        @endforeach
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Role -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label"> Roles </label>
                      <!-- Input -->
                      <select name="role_id" id="role_id" class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
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
                  Create Role Permissions
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
