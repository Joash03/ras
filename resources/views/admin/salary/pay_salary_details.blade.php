@extends('admin.admin_dashboard')

@section('admin')

<div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Header -->
        <div class="header">
            <!-- Image -->
            <img src="{{ asset('backend/assets/img/covers/profile-cover-1.jpg') }}" class="header-img-top" alt="...">
              <!-- Body -->
              <div class="header-body border-0 mt-n5 mt-md-n6">
                <div class="container-fluid">
                  <!-- Form -->
                  <form class="mb-4" action="{{ route('salary.pay.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                    @csrf

                    <input type="hidden" name="id" value="{{ $paysalaryDetails->employee_id }}">

                    <div class="row align-items-end">
                      <div class="col-auto">
                        <!-- Avatar -->
                        <div class="avatar avatar-xxl header-avatar-top">
                          <img src="{{ (!empty($paysalaryDetails->user->photo)) ? url('uploads/employee_images/'.$paysalaryDetails->user->photo) : url('uploads/no_image.jpg') }}" alt="photo" class="avatar-img rounded">
                        </div>
                      </div>
                      <div class="col mb-3 ms-n3 ms-md-n2">
                        <!-- Pretitle -->
                        <h6 class="header-pretitle">{{ $paysalaryDetails->user->role }}</h6>
                        <!-- Title -->
                        <h1 class="header-title">{{ $paysalaryDetails->user->name }}</h1>
                      </div>
                      <div class="col-12 col-md-auto mt-2 mb-md-3">
                          <!-- Button -->
                          <button type="submit" class="btn btn-outline-primary ms-2">Pay Salary</button>
                      </div>
                    </div> <!-- / .row -->

                    <div class="row card mt-5">
                      <div class="card-body">
                        <!-- Features -->
                        <div class="mb-3">
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Account Status</h4> <h4 class="fw-normal mb-1"><span class="item-score badge {{ $paysalaryDetails->user->status == 'active' ? ' bg-primary-soft':'bg-danger-soft' }}">{{ $paysalaryDetails->user->status  == 'active' ? 'Active':'Inactive' }}</span></h4>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Email</h4> <h4 class="fw-normal mb-1">{{ $paysalaryDetails->user->email }}</h4>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Phone</h4> <h4 class="fw-normal mb-1">{{ $paysalaryDetails->user->phone }}</h4>
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Month</h4> <h4 class="fw-normal mb-1">{{ date("F", strtotime('-1 month'))}}</h4>
                              <input type="hidden" name="salary_month" value="{{ date("F", strtotime('-1 month')) }}">
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Salary</h4> <h4 class="fw-normal mb-1">#<strong>{{ $paysalaryDetails->salary }}</strong></h4>
                              <input type="hidden" name="paid_amount" value="{{ $paysalaryDetails->salary }}">
                            </li>
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Advance Salary</h4> <h4 class="fw-normal mb-1">
                                @if ($paysalaryDetails->advanceSalary)
                                <!-- Text -->
                                <a class="paysalaryDetails-name text-reset">#<strong>{{ $paysalaryDetails->advanceSalary->advance_salary }}</strong></a>
                                <input type="hidden" name="advance_salary" value="{{ $paysalaryDetails->advanceSalary->advance_salary }}">
                              @else
                                  <a class="item-name text-reset">No Advance</a>
                              @endif</h4>
                            </li>
                            <!-- Calculate and display due amount -->
                            @php
                            $advanceSalary = $paysalaryDetails->advanceSalary ? $paysalaryDetails->advanceSalary->advance_salary : 0;
                            $due = $paysalaryDetails->salary - $advanceSalary;
                            @endphp
                            <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                              <h4 class="fw-normal mb-1">Due Salary</h4> <h4 class="fw-normal mb-1">
                              @if ($due > 0)
                              <a class="item-name text-reset">#<strong>{{ $due }}</strong> </a>
                              <input type="hidden" name="due_salary" value="{{ $due }}">
                              @else
                              <a class="item-name text-reset">No Due</a>
                              @endif
                            </h4>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </form>
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
