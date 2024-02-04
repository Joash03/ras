@extends('admin.admin_dashboard')

@section('admin')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header">
            <!-- Image -->
            <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}"  class="header-img-top" style="height: 250px; object-fit: cover" alt="...">
              <!-- Body -->
              <div class="header-body border-0 mt-n5 mt-md-n6">
                <div class="container-fluid">
                  <div class="row align-items-end">
                    <div class="col-auto">
                      <!-- Avatar -->
                      <div class="avatar avatar-xxl header-avatar-top">
                        <img src="{{ (!empty($employeeDetails->photo)) ? url('uploads/employee_images/'.$employeeDetails->photo) : url('uploads/no_image.jpg') }}" alt="photo" class="avatar-img rounded">
                      </div>
                    </div>
                    <div class="col mb-3 ms-n3 ms-md-n2">
                      <!-- Pretitle -->
                      <h6 class="header-pretitle">{{ $employeeDetails->role }}</h6>
                      <!-- Title -->
                      <h1 class="header-title">{{ $employeeDetails->name }}</h1>
                    </div>
                    <div class="col-12 col-md-auto mt-2 mb-md-3">
                        <!-- Button -->
                        <a href="{{ route('employee.edit', $employeeDetails->id) }}" class="btn btn-primary ms-2">Edit Details</a>
                    </div>
                  </div> <!-- / .row -->
                  <div class="row card mt-5">
                    <div class="card-body">
                      <!-- Features -->
                      <div class="mb-3">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Username</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->username }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Account Status</h4> <h4 class="fw-normal mb-1"><span class="item-score badge {{ $employeeDetails->status == 'active' ? ' bg-primary-soft':'bg-danger-soft' }}">{{ $employeeDetails->status  == 'active' ? 'Active':'Inactive' }}</span></h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Email</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->email }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Phone</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->phone }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Address</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->address }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Gender</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->gender }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Date of Birth</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->dob }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Religion</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->religion }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Next of Kin</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->next_kin }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Blood Group</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->blood_group }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Qualification</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->qualification }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Salary</h4> <h4 class="fw-normal mb-1">#{{ $employeeDetails->salary }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Appointment date</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->appointment_date }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Default Password</h4> <h4 class="fw-normal mb-1">password123</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Date Joined</h4> <h4 class="fw-normal mb-1">{{ $employeeDetails->created_at }}</h4>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- / .header-body -->
        </div>
      </div>
    </div> <!-- / .row -->
  </div>

  <!-- JAVASCRIPT -->
  <script>
    $(document).ready(function () {
        // Handle form submission
        $('.delete-button').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var form = $(this).closest('form'); // Get the parent form

            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ED1C24',
                cancelButtonColor: '#CE7F36',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    form.submit();
                    Swal.fire({
                        title: 'Success',
                        text: 'Category has been deleted successfully!',
                        icon: 'success',
                        showConfirmButton: true
                    });
                }
                else {
                    // If cancel button is clicked, show a cancel message
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Delete action has been cancelled!',
                        icon: 'info',
                        showConfirmButton: true
                    });
                }
            });
        });
    });


  </script>

@endsection
