@extends('admin.admin_dashboard')

@section('admin')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

         <!-- Header -->
         <div class="header">
            <!-- Image -->
            <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}" class="header-img-top" style="height: 250px; object-fit: cover" alt="...">
              <!-- Body -->
              <div class="header-body mt-n5 mt-md-n6">
                <div class="container-fluid">
                  <div class="row align-items-end">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <div class="avatar avatar-xxl header-avatar-top">
                        <img src="{{ (!empty($profileData->photo)) ? url('uploads/admin_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" alt="photo" class="avatar-img rounded">
                      </div>
                    </div>
                    <div class="col mb-3 ms-n3 ms-md-n2">
                      <!-- Pretitle -->
                      <h6 class="header-pretitle">{{ $profileData->role }}</h6>
                      <!-- Title -->
                      <h1 class="header-title">{{ $profileData->name }}</h1>
                    </div>
                    <div class="col-12 col-md-auto mt-2 mb-md-3">
                      <!-- Button -->
                      <a href="#editProfile" class="btn btn-primary ms-2">Edit Profile</a>
                      <!-- Button -->
                      <a href="{{ route('admin.change.password') }}" class="btn btn-primary ms-2">Change Password</a>
                    </div>
                  </div> <!-- / .row -->
                  <div class="row card mt-5">
                    <div class="card-body">

                      <!-- Features -->
                      <div class="mb-3">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Username</h4> <h4 class="fw-normal mb-1">{{ $profileData->username }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Account Status</h4> <h4 class="fw-normal mb-1"><span class="item-score badge {{ $profileData->status == 'active' ? ' bg-primary-soft':'bg-danger-soft' }}">{{ $profileData->status  == 'active' ? 'Active':'Inactive' }}</span></h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Email</h4> <h4 class="fw-normal mb-1">{{ $profileData->email }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Phone</h4> <h4 class="fw-normal mb-1">{{ $profileData->phone }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Address</h4> <h4 class="fw-normal mb-1">{{ $profileData->address }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Date Joined</h4> <h4 class="fw-normal mb-1">{{ $profileData->created_at }}</h4>
                          </li>
                          {{-- <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <small>Direct messaging</small> <i class="fe fe-check-circle text-success"></i>
                          </li> --}}
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div> <!-- / .header-body -->
         </div>

        <!-- Tab content -->
        <div class="tab-content">
          <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
            <div class="row">
              <div class="container-fluid">
                  <div class="card" id="editProfile">
                    <div class="card-body">

                      <div class="row justify-content-between align-items-center mb-4">
                        <div class="col-12">

                          <!-- Heading -->
                          <h2 class="mb-2">
                            Update Account Details
                          </h2>

                          <!-- Text -->
                          <p class="text-muted mb-xl-0">
                            Fill up the form below to update your account information.
                          </p>

                        </div>
                      </div>

                      <!-- Form -->
                      <form class="mb-4" method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data" onsubmit="return validateForm();">
                          @csrf

                          <div class="row">
                            <div class="col-12 col-md-6">
                              <!-- Name -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="form-label">Name</label>
                                <!-- Input -->
                                <input type="text" class="form-control" id="name" name="name" value="{{ $profileData->name }}">
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Username -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="form-label">Username</label>
                                <!-- Input -->
                                <input type="text" class="form-control" id="username" name="username" value="{{ $profileData->username }}">
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Email address -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="form-label">Email address</label>
                                <!-- Input -->
                                <input type="email" class="form-control"  id="email" name="email" value="{{ $profileData->email }}">
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Phone -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="form-label">Phone</label>
                                <!-- Input -->
                                <input type="text" class="form-control mb-3" placeholder="+234 ___-_______" data-inputmask='"mask": "+234 999 9999 999"' inputmode="text" id="phone" name="phone" value="{{ $profileData->phone }}">
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Profile photo -->
                              <div class="form-group">
                                <!-- Label  -->
                                <label class="form-label mb-1" for="photo">Profile Photo</label>
                                <!-- Input -->
                                <input class="form-control" type="file" id="photo" name="photo" accept="image/*">
                                <!-- Image preview -->
                                <img src="{{ (!empty($profileData->photo)) ? asset('uploads/admin_images/'.$profileData->photo) : asset('uploads/no_image.jpg') }}" alt="{{ $profileData->username }}" alt="photo" id="showphoto" style="max-width: 15%; padding-top: 10px; display: none;">
                              </div>
                            </div>
                            <div class="col-12 col-md-6">
                              <!-- Address -->
                              <div class="form-group">
                                <!-- Label -->
                                <label class="form-label mb-1">Address</label>
                                <!-- Input -->
                                <input type="text" class="form-control" id="address" name="address" value="{{ $profileData->address }}">
                              </div>
                            </div>
                          </div> <!-- / .row -->

                          <!-- Divider -->
                          <hr class="mt-5 mb-5">

                          <!-- Button -->
                          <button type="submit" class="btn w-100 btn-primary">
                            Update Details
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
    $(document).ready(function () {
          $('#photo').change(function (e) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('#showphoto').attr('src', e.target.result);
              }
              reader.readAsDataURL(e.target.files[0]);
          });

          // // Initially display "no_image.jpg"
          $('#showphoto').css('display', 'block');
    });

    // Function to validate the form
    function validateForm() {
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;

        // Check if the name field is empty
        if (name === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in the Name field!',
            });
            return false; // Prevent form submission
        }

        // Check if the email field is empty and is a valid email address
        if (email === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in the Email field!',
            });
            return false; // Prevent form submission
        }
        else if (!isValidEmail(email)) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter a valid email address!',
        });
        return false; // Prevent form submission
        }

        // Check if the phone field is empty
        if (phone === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in the Phone field!',
            });
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

    // Function to validate email address format
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>

@endsection
