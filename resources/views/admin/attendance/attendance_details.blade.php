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
              <h6 class="header-pretitle">Overview</h6>
              <!-- Title -->
              <h1 class="header-title text-truncate">Attendance Details</h1>
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
                      <input class="form-control list-search" type="search" placeholder="Search">
                      <span class="input-group-text">
                        <i class="fe fe-search"></i>
                      </span>
                    </div>
                  </form>
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
                              <a class="list-sort text-muted" data-sort="item-title">Name</a>
                          </th>
                          <th>
                              <a class="list-sort text-muted" data-sort="item-title">Phone</a>
                          </th>
                          <th>
                              <a class="list-sort text-muted" data-sort="item-title">Date</a>
                          </th>
                          <th>
                              <a class="list-sort text-muted" data-sort="item-title">Status</a>
                          </th>
                      </tr>
                  </thead>
                  <tbody class="list fs-base">
                    @if ($detailsData->isEmpty())
                        <tr>
                            <td></td>
                            <td></td>
                            <td  class="item-name h4 text-center">Attendance List is Empty!</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                      @foreach ($detailsData as $item)
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
                              <!-- Text -->
                              <a class="item-name text-reset">{{ $item->user->phone }}</a>
                          </td>
                          <td>
                              <!-- Text -->
                              <a class="item-name text-reset">{{ date('Y-m-d', strtotime($item->date))  }}</a>
                          </td>
                          <td>
                            <!-- Status Badge -->
                            @if ($item->status == 'present')
                                <span class="item-score badge bg-info-soft">Present</span>
                            @elseif ($item->status == 'leave')
                                <span class="item-score badge bg-info-soft">Leave</span>
                            @else
                                <span class="item-score badge bg-danger-soft">Absent</span>
                            @endif
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

    </div>
  </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT -->
<script>

</script>

@endsection
