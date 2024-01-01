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
              <h1 class="header-title text-truncate">Employe Roles Index</h1>
            </div>
            <div class="col-auto">
              <!-- Buttons -->
              <a href="{{ route('admin.employee.role.add') }}" class="btn btn-outline-primary ms-2">Add Employe Role</a>
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
                              <a class="list-sort text-muted" data-sort="item-title">Role</a>
                          </th>
                          <th>
                              <a class="list-sort text-muted" data-sort="item-title">Status</a>
                          </th>
                          <th>
                              <a class="list-sort text-muted" data-sort="item-title">Action</a>
                          </th>
                      </tr>
                  </thead>
                  <tbody class="list fs-base">
                      @foreach ($employees as $item)
                      <tr>
                          <td>
                              {{ $loop->index + 1 }}
                          </td>
                          <td>
                              <!-- Avatar -->
                              <div class="avatar avatar-sm align-middle me-2">
                                  <img class="avatar-img rounded" src="{{ (!empty($item->photo)) ? url('uploads/'.($item->role == 'admin' ? 'admin_images/' : 'employee_images/').$item->photo) : url('uploads/no_image.jpg') }}"
                                      alt="{{ $item->name }}">
                              </div>
                          </td>
                          <td>
                              <!-- Text -->
                              <a class="item-name text-reset">{{ $item->name }}</a>
                          </td>
                          <td>
                              <!-- Text -->
                              <a class="item-name text-reset">{{ $item->phone }}</a>
                          </td>
                          <td>
                            <div class="d-flex flex-wrap">
                                @if($item->roles)
                                    @foreach($item->roles as $role)
                                        <!-- Type Badge -->
                                        <span class="item-score badge bg-dark-soft" style="margin-right: 8px; margin-bottom: 8px; line-height: 1.5;">{{ $role->name }}</span>
                                    @endforeach
                                @else
                                    <!-- Handle the case where $item->roles is null -->
                                    <span class="item-score badge bg-dark-soft">No roles assigned</span>
                                @endif
                            </div>
                          </td>
                          <td>
                              <!-- Status Badge -->
                              <span class="item-score badge {{ $item->status == 'active' ? 'bg-info-soft' : 'bg-danger-soft' }}">{{ $item->status == 'active' ? 'Active' : 'Inactive' }}</span>
                          </td>
                          <td>
                              <div class="d-flex align-items-center ">
                                  <span style="margin-right: 5px">
                                      <!-- Button -->
                                      <a class="btn btn-outline-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" href="{{ route('admin.employee.role.edit', $item->id) }}">
                                          <span class="fe fe-edit"></span>
                                      </a>
                                  </span>
                                  <form method="POST" action="{{ route('admin.employee.role.detach', $item->id) }}" data-confirm-delete="true"
                                      data-id="{{ $item->id }}">
                                      @csrf
                                      <!-- Button to trigger deletion -->
                                      <button type="submit" class="btn btn-outline-danger btn-sm delete-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Unassign Role">
                                          <span class="fe fe-link"></span>
                                      </button>
                                  </form>
                              </div>
                          </td>
                      </tr>
                      @endforeach
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
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
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
