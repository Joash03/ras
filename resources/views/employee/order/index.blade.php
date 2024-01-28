@extends('employee.employee_dashboard')

@section('employee')
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
              <h1 class="header-title text-truncate">
                {{ $page_title }}
              </h1>

            </div>
            <div class="col-auto">

              <!-- Buttons -->
              <a href="{{ route('menu') }}" class="btn btn-primary ms-2">
                New Order
              </a>

            </div>
          </div> <!-- / .row -->
        </div>
      </div>

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
            <div class="table-responsive">
              <table class="table table-sm table-hover table-nowrap card-table">
                <thead>
                  <tr>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name">S/N</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name">Reference</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Date</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Price</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Payment Status</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Order Status</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Action</a>
                    </th>
                  </tr>
                </thead>
                <tbody class="list fs-base">
                    @if ($orders->isEmpty())
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td  class="item-name h4 text-center">Order List is Empty!</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($orders as $item)
                        <tr>
                            <td>
                            {{ $loop->index + 1 }}
                            </td>
                            <td>
                                <!-- Text -->
                                <a class="item-name text-reset">{{ $item->reference }}</a>
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->transaction_date }}</a>
                            </td>
                            <td>
                            <!-- Text -->
                            <a class="item-name text-reset">#{{ $item->total }}</a>
                            </td>
                            <td>
                                <!-- Payment Status Badge -->
                                @php
                                    $paymentStatusClass = '';
                                    $paymentStatusText = '';
                                    if ($item->payment_status === 0) {
                                        $paymentStatusClass = 'bg-danger-soft';
                                        $paymentStatusText = 'Failed';
                                    } elseif ($item->payment_status === 1) {
                                        $paymentStatusClass = 'bg-success-soft';
                                        $paymentStatusText = 'Success';
                                    } elseif ($item->payment_status === 2) {
                                        $paymentStatusClass = 'bg-info-soft';
                                        $paymentStatusText = 'Pending';
                                    }
                                @endphp
                                <span class="item-score badge {{ $paymentStatusClass }}">{{ $paymentStatusText }}</span>
                            </td>
                            <td>
                                <!-- Order Status Badge -->
                                @php
                                    $orderStatusClass = '';
                                    $orderStatusText = '';
                                    if ($item->order_status === 0) {
                                        $orderStatusClass = 'bg-info-soft';
                                        $orderStatusText = 'Pending';
                                    } elseif ($item->order_status === 1) {
                                        $orderStatusClass = 'bg-success-soft';
                                        $orderStatusText = 'Completed';
                                    } elseif ($item->order_status === 2) {
                                        $orderStatusClass = 'bg-danger-soft';
                                        $orderStatusText = 'Canceled';
                                    }
                                @endphp
                                <span class="item-score badge {{ $orderStatusClass }}">{{ $orderStatusText }}</span>
                            </td>
                            <td>
                            <div class="d-flex align-items-center ">
                                <span style="margin-right: 5px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View">
                                    <!-- Button -->
                                    <a class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalOrderDetails{{ $item->id }}">
                                        <span class="fe fe-eye"></span>
                                    </a>
                                </span>
                                <!-- Modal: Order Details -->
                                <div class="modal fade" id="modalOrderDetails{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalOrderDetails{{ $item->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content bg-lighter">
                                    <div class="modal-body">

                                        <!-- Header -->
                                        <div class="row">
                                        <div class="col">
                                            <!-- Prettitle -->
                                            <h6 class="text-uppercase text-muted mb-3"><a href="#!" class="text-reset">Overview</a></h6>
                                            <!-- Title -->
                                            <h2 class="mb-2">Order Details</h2>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Close -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        </div> <!-- / .row -->

                                        <!-- Divider -->
                                        <hr class="my-3">

                                        <div class="row">
                                            <div class="card">
                                            <!-- Body -->
                                            <div class="card-body">
                                                <!-- Features -->
                                                <div class="mb-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Order Reference</h4>
                                                            <h4 class="fw-normal mb-1">{{ $item->reference }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Order Date</h4>
                                                            <h4 class="fw-normal mb-1">{{ $item->transaction_date }}</h4>
                                                        </li>
                                                        <!-- Payment Method -->
                                                        @php
                                                            if ($item->payment_method === 1) {
                                                                $paymentMethod = 'Flutterwave';
                                                            } elseif ($item->payment_method === 2) {
                                                                $paymentMethod = 'Paystack';
                                                            } elseif ($item->payment_method === 3) {
                                                                $paymentMethod = 'Direct Bank Transfer';
                                                            }
                                                        @endphp
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Payment Method</h4> <h4 class="fw-normal mb-1"> {{ $paymentMethod }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Channel</h4><h4 class="fw-normal mb-1">{{ $item->channel }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Order Status</h4>
                                                            <h4 class="fw-normal mb-1"><span class="item-score badge {{ $orderStatusClass }}">{{ $orderStatusText }}</span></h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Payment Status</h4> <h4 class="fw-normal mb-1"><span class="item-score badge {{ $paymentStatusClass }}">{{ $paymentStatusText }}</span></h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Order Items</h4>
                                                            <h4 class="fw-normal mb-1">
                                                                @php
                                                                    $orderItemsFound = false;
                                                                @endphp

                                                                @foreach ($orderdetails as $orderitem)
                                                                    @if ($item->reference === $orderitem->reference)
                                                                        <span style="margin-right: 25px; margin-bottom: 10px;">{{ $orderitem->item_name }}</span> <span> X {{ $orderitem->quantity }}</span> <br>
                                                                        @php
                                                                            $orderItemsFound = true;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach

                                                                @if (!$orderItemsFound)
                                                                    No items found for this order.
                                                                @endif
                                                            </h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Total Price</h4>
                                                            <h4 class="fw-normal mb-1">#{{ $item->total }}</h4>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="row align-items-center">
                                            <div class="col">

                                            </div>
                                            <div class="col-auto">
                                            <!-- Buttons -->
                                            <a href="{{ route('employee.invoice', $item->id) }}" class="btn btn-primary ms-2">
                                                View Invoice
                                            </a>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                    </div>
                                </div>
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
