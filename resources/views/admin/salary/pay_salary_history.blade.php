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
                        <img src="{{ (!empty($paysalaryHistory->user->photo)) ? url('uploads/employee_images/'.$paysalaryHistory->user->photo) : url('uploads/no_image.jpg') }}" alt="photo" class="avatar-img rounded">
                      </div>
                    </div>
                    <div class="col mb-3 ms-n3 ms-md-n2">
                      <!-- Pretitle -->
                      <h6 class="header-pretitle">{{ $paysalaryHistory->user->role }}</h6>
                      <!-- Title -->
                      <h1 class="header-title">{{ $paysalaryHistory->user->name }}</h1>
                    </div>
                  </div> <!-- / .row -->

                  <div class="row card mt-5">
                    <div class="card-body">
                      <!-- Features -->
                      <div class="mb-3">
                        <ul class="list-group list-group-flush">
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Salary Status</h4> <h4 class="fw-normal mb-1"><span class="item-score badge bg-success-soft">Fully Paid</span></h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Email</h4> <h4 class="fw-normal mb-1">{{ $paysalaryHistory->user->email }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Phone</h4> <h4 class="fw-normal mb-1">{{ $paysalaryHistory->user->phone }}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Month</h4> <h4 class="fw-normal mb-1">{{ date("F", strtotime('-1 month'))}}</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Salary</h4> <h4 class="fw-normal mb-1">#<strong>{{ $paysalaryHistory->employee->salary }}</strong></h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Advance Salary</h4> <h4 class="fw-normal mb-1">No Advance
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Due Salary</h4> <h4 class="fw-normal mb-1">No Due</h4>
                          </li>
                          <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                            <h4 class="fw-normal mb-1">Amount Paid</h4> <h4 class="fw-normal mb-1">#<strong>{{ $paysalaryHistory->employee->salary }}</strong></h4>
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

  </script>

@endsection
