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
                Overview
              </h6>

              <!-- Title -->
              <h1 class="header-title text-truncate"> {{ date("d F Y") }}
                {{ $page_title }}
              </h1>

            </div>
            <div class="col-auto">
                <!-- Buttons -->
                <a href="{{ route('expense.create') }}" class="btn btn-outline-primary ms-2">Add Expense</a>
            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      @php
      $date = date("d-m-Y");
      $totalexpense = App\Models\Expense::where('date', $date)->sum('amount');

      @endphp
      <!-- Tab content -->
      <div class="tab-content">
        <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">

          <!-- Card -->
          <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
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
            <div class="d-flex align-items-center justify-content-left px-4 py-3">
                <h1 class="header-title text-truncate mb-1">Total Expense = #{{ $totalexpense }}.00</h1>
            </div>
            <div class="table-responsive">
              <table class="table table-sm table-hover table-nowrap card-table">
                <thead>
                  <tr>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >S/N</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Details</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title" >Amount</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Month</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Year</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title" >Action</a>
                    </th>
                  </tr>
                </thead>
                <tbody class="list fs-base">
                    @if ($daily->isEmpty())
                        <tr>
                            <td></td>
                            <td></td>
                            <td  class="item-name h4 text-center">Expenses List is Empty!</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($daily as $item)
                        <tr>
                            <td>
                            {{ $loop->index + 1 }}
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->details }}</a>
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">#{{ $item->amount }}</a>
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->month }}</a>
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->year }}</a>
                            </td>
                            <td>
                            <div class="d-flex align-items-center ">
                                @if(Auth::user()->can('expense.edit'))
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" href="{{ route('expense.edit', $item->id) }}">
                                        <span class="fe fe-edit"></span>
                                    </a>
                                </span>
                                @endif
                                @if(Auth::user()->can('expense.destroy'))
                                <form method="POST" action="{{ route('expense.destroy', $item->id) }}" data-confirm-delete="true"
                                    data-id="{{ $item->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <!-- Button to trigger deletion -->
                                    <button type="submit" class="btn btn-outline-danger btn-sm delete-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                        <span class="fe fe-trash-2"></span>
                                    </button>
                                </form>
                                @endif
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

    </div>
  </div> <!-- / .row -->
</div>

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
                      text: 'Expense record has been deleted successfully!',
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
