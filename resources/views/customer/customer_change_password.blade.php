@extends('customer.customer_dashboard')

@section('customer')

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
                    Overview
                  </h6>

                  <!-- Title -->
                  <h1 class="header-title">
                    Account Settings
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

                <div class="row justify-content-between align-items-center mb-5">
                  <div class="col-12 col-md-9 col-xl-6">

                    <!-- Heading -->
                    <h2 class="mb-2">
                      Change Password
                    </h2>

                    <!-- Text -->
                    <p class="text-muted mb-xl-0">
                      We will email you a confirmation when changing your password, so please expect that email after submitting.
                    </p>

                  </div>
                </div>

                <div class="row">
                  <div class="col-12 col-md-6 order-md-2">

                    <!-- Card -->
                    <div class="card bg-light border ms-md-4">
                      <div class="card-body">

                        <!-- Text -->
                        <p class="mb-2">
                          Password requirements
                        </p>

                        <!-- Text -->
                        <p class="small text-muted mb-2">
                          To create a new password, you have to meet all of the following requirements:
                        </p>

                        <!-- List group -->
                        <ul class="small text-muted ps-4 mb-0">
                          <li>
                            Minimum 8 character
                          </li>
                          <li>
                            At least one special character
                          </li>
                          <li>
                            At least one number
                          </li>
                          <li>
                            Can’t be the same as a previous password
                          </li>
                        </ul>

                      </div>
                    </div>

                  </div>
                  <div class="col-12 col-md-6">

                    <!-- Form -->
                    <form class="mb-4" method="POST" action="{{ route('customer.update.password') }}" enctype="multipart/form-data" onsubmit="return validateForm();">
                      @csrf

                      <!-- Password -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Current password</label>
                        <!-- Input -->
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="current_password" >
                            @error('old_password')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                            <!-- Icon -->
                            <span class="input-group-text current-toggle-password">
                                <i class="fe fe-eye"></i>
                            </span>
                        </div>
                      </div>

                      <!-- New password -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">New password</label>
                        <!-- Input -->
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="new_password" >
                            @error('new_password')
                            <span class="text-danger"> {{ $message }} </span>
                            @enderror
                            <!-- Icon -->
                            <span class="input-group-text new-toggle-password">
                                <i class="fe fe-eye"></i>
                            </span>
                        </div>
                      </div>

                      <!-- Confirm new password -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Confirm new password</label>
                        <!-- Input -->
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="new_password_confirmation" id="new_password_confirmation" >
                            <!-- Icon -->
                            <span class="input-group-text confirm-toggle-password">
                                <i class="fe fe-eye"></i>
                            </span>
                        </div>
                      </div>

                      <!-- Submit -->
                      <button class="btn w-100 btn-primary lift" type="submit">
                        Update password
                      </button>

                    </form>

                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT -->

<script>
    // Function to validate the form
    function validateForm() {
      var currentPassword = document.getElementById('current_password').value;
      var newPassword = document.getElementById('new_password').value;
      var confirmPassword = document.getElementById('new_password_confirmation').value;

      // Check if the current password is empty
      if (currentPassword === '') {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Please enter your current password.'
          });
          return false; // Prevent form submission
      }

      // Check if the new password meets your criteria (e.g., length, complexity)
      if (newPassword.length < 8) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'New password must be at least 8 characters long.'
          });
          return false; // Prevent form submission
      }

      // Check if the new password matches the confirmation
      if (newPassword !== confirmPassword) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'New password and confirmation do not match.'
          });
          return false; // Prevent form submission
      }

      return true; // Allow form submission
    }

    $(document).ready(function () {
        // Toggle password visibility when the eye icon is clicked
        $('.current-toggle-password').click(function () {
            var passwordField = $('#current_password');
            var fieldType = passwordField.attr('type');

            // Toggle between 'password' and 'text'
            passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fe-eye fe-eye-off');
        });
    });
    $(document).ready(function () {
        // Toggle password visibility when the eye icon is clicked
        $('.new-toggle-password').click(function () {
            var passwordField = $('#new_password');
            var fieldType = passwordField.attr('type');

            // Toggle between 'password' and 'text'
            passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fe-eye fe-eye-off');
        });
    });

    $(document).ready(function () {
        // Toggle password visibility when the eye icon is clicked
        $('.confirm-toggle-password').click(function () {
            var passwordField = $('#new_password_confirmation');
            var fieldType = passwordField.attr('type');

            // Toggle between 'password' and 'text'
            passwordField.attr('type', fieldType === 'password' ? 'text' : 'password');
            $(this).find('i').toggleClass('fe-eye fe-eye-off');
        });
    });
</script>

@endsection
