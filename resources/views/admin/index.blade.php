@extends('admin.admin_dashboard')

@section('admin')


<!-- HEADER -->
<div class="header">
  <div class="container-fluid">

    <!-- Body -->
    <div class="header-body">
      <div class="row align-items-end">
        <div class="col">

          <!-- Pretitle -->
          <h6 class="header-pretitle">
            Overview
          </h6>

          <!-- Title -->
          <h1 class="header-title">
            Dashboard
          </h1>

        </div>
        <div class="col-auto">
            <!-- Icon -->
            <h2 class="header-title">
                <span class="h2 fe fe-calendar mb-0"></span>
                {{ $date }}
            </h2>

          {{-- <!-- Button -->
          <a href="#!" class="btn btn-primary lift">
            Create Report
          </a> --}}

        </div>
      </div> <!-- / .row -->
    </div> <!-- / .header-body -->

  </div>
</div> <!-- / .header -->

<div class="container-fluid">

    <!-- Activity Summary -->
    <div class="card">
      <div class="card-header">
        <!-- Title -->
        <h3 class="card-header-title">
          Activity Summary
        </h3>
        <!-- Switch -->
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="cardToggle" data-toggle="chart" data-target="#conversionsChart" data-trigger="change" data-action="add" data-dataset="1" checked />
            <label class="form-check-label" for="cardToggle"></label>
        </div>
      </div>
    </div>

    <div id="contentToToggle">
        <div class="row">
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        {{ $month }} Total Sales
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        #{{ $totalSales }}.00
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-dollar-sign text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        {{ $month }} Total Expenses
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        #{{ $totalExpenses  }}.00
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-dollar-sign text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        {{ $monthsal }} Salary Paid
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        #{{ $totalSalary  }}.00
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-dollar-sign text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Customer
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($customers)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-users text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Employee
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($employees)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-users text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Supplier
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($suppliers)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-users text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Product
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($products)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-package text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Menue
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($menues)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-circle text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Blog Post
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($blogs)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-feather text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Store Item
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($storeinventories)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-archive text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Order
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($totalorders) }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-clipboard text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Pending Order
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($pendingorders)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-clipboard text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total Reservation
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($totalreservations)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-edit text-primary mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl">
              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">
                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Pending Reservation
                      </h6>
                      <!-- Heading -->
                      <span class="h2 mb-0">
                        {{ count($pendingreservations)  }}
                      </span>
                    </div>
                    <div class="col-auto">
                      <!-- Icon -->
                      <span class="h2 fe fe-edit text-danger mb-0"></span>
                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12 col-lg-6 col-xl">

              <!-- Time -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">

                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Avg. Time
                      </h6>

                      <!-- Heading -->
                      <span class="h2 mb-0">
                        2:37
                      </span>

                    </div>
                    <div class="col-auto">

                      <!-- Icon -->
                      <span class="h2 fe fe-clock text-muted mb-0"></span>

                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

              <!-- Exit -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">

                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Exit %
                      </h6>

                      <!-- Heading -->
                      <span class="h2 mb-0">
                        35.5%
                      </span>

                    </div>
                    <div class="col-auto">

                      <!-- Chart -->
                      <div class="chart chart-sparkline">
                        <canvas class="chart-canvas" id="sparklineChart" style="display: block; box-sizing: border-box; height: 35px; width: 75px;" width="75" height="35"></canvas>
                      </div>

                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

              <!-- Hours -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">

                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Total hours
                      </h6>

                      <!-- Heading -->
                      <span class="h2 mb-0">
                        763.5
                      </span>

                    </div>
                    <div class="col-auto">

                      <!-- Icon -->
                      <span class="h2 fe fe-briefcase text-muted mb-0"></span>

                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>

            </div>
            <div class="col-12 col-lg-6 col-xl">

              <!-- Value  -->
              <div class="card">
                <div class="card-body">
                  <div class="row align-items-center gx-0">
                    <div class="col">

                      <!-- Title -->
                      <h6 class="text-uppercase text-muted mb-2">
                        Value
                      </h6>

                      <!-- Heading -->
                      <span class="h2 mb-0">
                        $24,500
                      </span>

                      <!-- Badge -->
                      <span class="badge bg-success-soft mt-n1">
                        +3.5%
                      </span>
                    </div>
                    <div class="col-auto">

                      <!-- Icon -->
                      <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>

                    </div>
                  </div> <!-- / .row -->
                </div>
              </div>

            </div>
        </div> --}}
    </div>

  <div class="row">
    @if(Auth::user()->can('order.menu'))
    <div class="col-12 col-xl-8">
        <div class="card">
            <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 7}'>
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h3 class="card-header-title">
                          New Order
                        </h3>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-link ms-2" href="{{ route('order.index') }}">
                            View Details
                        </a>
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
                      </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($pendingorders->isEmpty())
                            <tr>
                                <td></td>
                                <td></td>
                                <td  class="item-name h4 text-center">No New Order!</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($pendingorders as $item)
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
                                    <td class="text-center">
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
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="col-12 col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                <div class="col">
                    <!-- Title -->
                    <h3 class="card-header-title">
                        Quick Add
                    </h3>
                </div>
                <div class="col-auto">

                </div>
                </div> <!-- / .row -->
            </div>
            <div class="card-body mx-2">
                <!-- List group -->
                <div class="list-group list-group-flush my-n4">
                    @if(Auth::user()->can('employee.add'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Employee</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('employee.add') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('customer.add'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Customer</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('customer.add') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('supplier.add'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Supplier</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('supplier.add') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('menu.create'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Menu</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('menu.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('product.create'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Product</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('product.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('blog.create'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Blog Post</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('blog.create') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif

                    @if(Auth::user()->can('inventory.store.add'))
                    <div class="list-group-item">
                        <div class="row align-items-center">
                            <div class="col">
                                <!-- Title -->
                                <h4 class="mb-0">Store Item</h4>
                            </div>
                            <div class="col-auto">
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('inventory.store.add') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add">
                                        <span class="fe fe-plus"></span>
                                    </a>
                                </span>
                            </div>
                        </div> <!-- / .row -->
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </div> <!-- / .row -->
  <div class="row">
    @if(Auth::user()->can('reserve.menu'))
    <div class="col-12 col-xl-8">
        <div class="card">
            <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 5}'>
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h3 class="card-header-title">
                          New Reservations
                        </h3>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-link ms-2"  href="{{ route('reserve.index') }}">
                            View Details
                        </a>
                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                      <tr>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-name" href="#">S/N</a>
                        </th>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-name" href="#">Date</a>
                        </th>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-title" href="#">Name</a>
                        </th>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-title" href="#">Time</a>
                        </th>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-title" href="#">People</a>
                        </th>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-title" href="#">Status</a>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($pendingreservations->isEmpty())
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="h3 text-center">No Item Found!</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($pendingreservations as $item)
                                <tr>
                                    <td>
                                    {{ $loop->index + 1 }}
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">{{ $item->date }}</a>
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">{{ $item->name }}</a>
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">{{ $item->time }}</a>
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">{{ $item->people }}</a>
                                    </td>
                                    <td>
                                    <!-- Status Badge -->
                                    <span class="item-score badge {{ $item->status === 0 ? 'bg-info-soft':($item->status === 1 ? 'bg-info-soft':'bg-danger-soft') }}">{{ $item->status === 0 ? 'Pending':($item->status === 1 ? 'Reserved':'Canceled') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if(Auth::user()->can('product.menu'))
    <div class="col-12 col-xl-4">
        <div class="card">
            <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 5}'>
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h3 class="card-header-title">
                          Product Out of Stock
                        </h3>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        @if(Auth::user()->can('inventory.product.menu'))
                        <a class="btn btn-outline-primary btn-sm" href="{{  route('inventory.product.outofstock') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View Details">
                            <span class="fe fe-eye"></span>
                        </a>
                        @endif
                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                      <tr>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-name" >Products</a>
                        </th>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($outofstockproducts->isEmpty())
                            <tr>
                                <td class="h4 text-center">No Product is Out of Stock!</td>
                            </tr>
                        @else
                            @foreach ($outofstockproducts as $item)
                                <tr>
                                    <td>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="project-overview.html" class="avatar avatar-md">
                                                <img src="{{ (!empty($item->thumbnail)) ? url('uploads/product_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}" class="avatar-img rounded">
                                                </a>
                                            </div>
                                            <div class="col ms-n2">
                                                <!-- Title -->
                                                <h4 class="item-name mb-1"><a href="project-overview.html">{{ $item->name }}</a></h4>
                                                <!-- Text -->
                                                <p class="text-muted mb-0">{{ $item->category->name }}</p>
                                            </div>
                                            <div class="col-auto">
                                                <span style="margin-right: 5px">
                                                    <!-- Button -->
                                                    <a class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add" href="{{ route('product.edit', $item->id) }}">
                                                        <span class="fe fe-plus"></span>
                                                    </a>
                                                </span>
                                            </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    @endif

  </div> <!-- / .row -->

  <div class="row">
    <div class="col-12 col-xl-8">

      <!-- Activity -->
      <div class="card card-fill">
        <div class="card-header">

          <!-- Title -->
          <h4 class="card-header-title">
            Recent Activity
          </h4>

          <!-- Button -->
          <a class="small" href="#!">
                View Details
          </a>

        </div>
        <div class="card-body">

          <!-- List group -->
          <div class="list-group list-group-flush list-group-activity my-n3">
            <div class="list-group-item">
              <div class="row">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-sm avatar-online">
                    <img class="avatar-img rounded-circle" src="{{ asset("backend/assets/img/avatars/profiles/avatar-1.jpg") }}" alt="..." />
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Heading -->
                  <h5 class="mb-1">
                    Dianna Smiley
                  </h5>

                  <!-- Text -->
                  <p class="small text-gray-700 mb-0">
                    Uploaded the files "Launchday Logo" and "New Design".
                  </p>

                  <!-- Time -->
                  <small class="text-muted">
                    2m ago
                  </small>

                </div>
              </div> <!-- / .row -->
            </div>
            <div class="list-group-item">
              <div class="row">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-sm avatar-online">
                    <img class="avatar-img rounded-circle" src="{{ asset("backend/assets/img/avatars/profiles/avatar-2.jpg") }}" alt="..." />
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Heading -->
                  <h5 class="mb-1">
                    Ab Hadley
                  </h5>

                  <!-- Text -->
                  <p class="small text-gray-700 mb-0">
                    Shared the "Why Dashkit?" post with 124 subscribers.
                  </p>

                  <!-- Time -->
                  <small class="text-muted">
                    1h ago
                  </small>

                </div>
              </div> <!-- / .row -->
            </div>
            <div class="list-group-item">
              <div class="row">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-sm avatar-offline">
                    <img class="avatar-img rounded-circle" src="{{ asset("backend/assets/img/avatars/profiles/avatar-3.jpg") }}" alt="..." />
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Heading -->
                  <h5 class="mb-1">
                    Adolfo Hess
                  </h5>

                  <!-- Text -->
                  <p class="small text-gray-700 mb-0">
                    Exported sales data from Launchday's subscriber data.
                  </p>

                  <!-- Time -->
                  <small class="text-muted">
                    3h ago
                  </small>

                </div>
              </div>
              <!-- / .row -->
            </div>
          </div>

        </div>
      </div>

    </div>
    @if(Auth::user()->can('product.menu'))
    <div class="col-12 col-xl-4">
        <div class="card">
            <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 5}'>
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col">
                        <!-- Title -->
                        <h3 class="card-header-title">
                          Expired Products
                        </h3>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        @if(Auth::user()->can('inventory.product.menu'))
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('inventory.product.expiredproduct') }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View Details">
                            <span class="fe fe-eye"></span>
                        </a>
                        @endif
                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                  <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                      <tr>
                        <th>
                          <a class="list-sort text-muted" data-sort="item-name" >Products</a>
                        </th>
                        </th>
                      </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($expiredproducts->isEmpty())
                            <tr>
                                <td class="h4 text-center">No Expired Product!</td>
                            </tr>
                        @else
                            @foreach ($expiredproducts as $item)
                                <tr>
                                    <td>
                                        <div class="list-group-item">
                                            <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <a href="project-overview.html" class="avatar avatar-md">
                                                <img src="{{ (!empty($item->thumbnail)) ? url('uploads/product_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}" class="avatar-img rounded">
                                                </a>
                                            </div>
                                            <div class="col ms-n2">
                                                <!-- Title -->
                                                <h4 class="item-name mb-1"><a href="project-overview.html">{{ $item->name }}</a></h4>
                                                <!-- Text -->
                                                <p class="text-muted mb-0">{{ $item->category->name }}</p>
                                            </div>
                                            <div class="col-auto">
                                                <span style="margin-right: 5px">
                                                    <!-- Button -->
                                                    <a class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" href="{{ route('product.edit', $item->id) }}">
                                                        <span class="fe fe-edit"></span>
                                                    </a>
                                                </span>
                                            </div>
                                            </div> <!-- / .row -->
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    @endif
  </div> <!-- / .row -->

</div>

<script>
    // Get the switch button and the content div
    var toggleSwitch = document.getElementById('cardToggle');
    var contentToToggle = document.getElementById('contentToToggle');

    // Set the initial state based on the switch's checked property
    contentToToggle.style.display = toggleSwitch.checked ? 'block' : 'none';

    // Add an event listener to the switch button
    toggleSwitch.addEventListener('change', function () {
      // Toggle the visibility of the content div based on the switch state
      contentToToggle.style.display = toggleSwitch.checked ? 'block' : 'none';
    });
</script>

@endsection
