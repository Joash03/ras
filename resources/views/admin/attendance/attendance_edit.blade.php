@extends('admin.admin_dashboard')

@section('admin')


<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12">
      <!-- Form -->
      <form action="{{ route('employee.attendance.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        @csrf

        <!-- Header -->
        <div class="header">
          <div class="header-body">
            <div class="row align-items-center">
              <div class="col">
                <!-- Pretitle -->
                <h6 class="header-pretitle">Update</h6>
                <!-- Title -->
                <h1 class="header-title text-truncate">Update Attendance</h1>
              </div>
              <div class="col-auto">
                <!-- Buttons -->
                <a href="{{ route('employee.attendance') }}" class="btn btn-primary ms-2">Attendance List</a>
              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        <!-- Tab content -->
        <div class="tab-content">
          <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">

              <!-- Card header -->
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col">
                    <!-- Form -->
                    <form>
                      <div class="input-group input-group-flush input-group-merge input-group-reverse">
                        <!-- Input -->
                        <input type="date" name="date" id="date" class="form-control flatpickr-input" placeholder="Attendance Date" data-flatpickr="" value="{{ $editData['0']['date'] }}">
                        <span class="input-group-text">
                          <i class="fe fe-calendar"></i>
                        </span>
                      </div>
                    </form>
                  </div>
                  <div class="col-auto">
                      <!-- Buttons -->
                      <a class="btn btn-outline-dark ms-2" onclick="resetPage()">Reset Input</a>
                      <button type="submit" class="btn btn-outline-primary ms-2">Submit Attendance</button>
                  </div>
                </div> <!-- / .row -->
              </div>

              <div class="table-responsive">
                <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                        <tr>
                            <th>
                                <a class="list-sort text-muted" data-sort="item-name">S/N</a>
                            </th>
                            <th>
                                <a class="list-sort text-muted" data-sort="item-name">Photo</a>
                            </th>
                            <th>
                                <a class="list-sort text-muted" data-sort="item-name">Name</a>
                            </th>
                            <th>
                                <a class="list-sort text-muted" data-sort="item-title">Action</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($editData->isEmpty())
                            <tr>
                                <td></td>
                                <td  class="item-name h4 text-center">Attendance List is Empty!</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($editData as $item)
                            <input type="hidden" name="employee_id[]" value="{{ $item->employee_id }}" class="form-control">
                            <tr>
                                <td>
                                    {{ $loop->index + 1 }}
                                </td>
                                <td>
                                    <!-- Avatar -->
                                    <div class="avatar avatar-sm align-middle me-2">
                                        <img class="avatar-img rounded" src="{{ (!empty($item->user->photo)) ? url('uploads/employee_images/'.$item->user->photo) : url('uploads/no_image.jpg') }}"
                                            alt="{{ $item->user->name }}">
                                    </div>
                                </td>
                                <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">{{ $item->user->name }}</a>
                                </td>
                                <td>
                                <!-- Status Button toggle -->
                                <div class="form-group">
                                    <!-- Label -->
                                    <div class="btn-group-toggle">
                                    <input type="radio" class="btn-check" name="attend_status[{{$item->employee_id}}]" id="present{{$item->employee_id}}" value="present" autocomplete="off" {{ $item->status == 'present' ? ' checked' : '' }} >
                                    <label class="btn btn-white" for="present{{$item->employee_id}}">
                                        <i class="fe fe-check-circle"></i> Present
                                    </label>

                                    <input type="radio" class="btn-check" name="attend_status[{{$item->employee_id}}]" id="leave{{$item->employee_id}}" value="leave" autocomplete="off" {{ $item->status == 'leave' ? ' checked' : '' }} >
                                    <label class="btn btn-white" for="leave{{$item->employee_id}}">
                                        <i class="fe fe-check-circle"></i> Leave
                                    </label>

                                    <input type="radio" class="btn-check" name="attend_status[{{$item->employee_id}}]" id="absent{{$item->employee_id}}" value="absent" autocomplete="off" {{ $item->status == 'absent' ? ' checked' : '' }} >
                                    <label class="btn btn-white" for="absent{{$item->employee_id}}">
                                        <i class="fe fe-check-circle"></i> Absent
                                    </label>

                                    </div>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
              </div>

              <div class="card-footer d-flex justify-content-between">
                <!-- Pagination (prev) -->
                <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
                  <li class="page-item">
                    <a class="page-link ps-0 pe-4 border-end" href="#">
                      <i class="fe fe-arrow-left me-1"></i> Prev
                    </a>
                  </li>
                </ul>
                <!-- Pagination -->
                <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>
                <!-- Pagination (next) -->
                <ul class="list-pagination-next pagination pagination-tabs card-pagination">
                  <li class="page-item">
                    <a class="page-link ps-4 pe-0 border-start" href="#">
                      Next <i class="fe fe-arrow-right ms-1"></i>
                    </a>
                  </li>
                </ul>

              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT -->
<script>
    function resetPage() {
        // Reload the current page
        location.reload();
    }
</script>

@endsection
