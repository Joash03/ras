@extends('customer.customer_dashboard')

@section('customer')
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
            <a href="#!" class="btn btn-outline-primary lift">
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
                          Completed Order
                        </h6>
                        <!-- Heading -->
                        <span class="h2 mb-0">
                          {{ count($totalorders)  }}
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
                          {{ count($totalpendingorders)  }}
                        </span>
                      </div>
                      <div class="col-auto">
                        <!-- Icon -->
                        <span class="h2 fe fe-clipboard text-warning mb-0"></span>
                      </div>
                    </div> <!-- / .row -->
                  </div>
                </div>
              </div>
          </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 5}'>
                    <div class="card-header">
                      <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h3 class="card-header-title">
                              Pending Order
                            </h3>
                        </div>
                        <div class="col-auto">
                            <!-- Buttons -->
                            <a class="btn btn-outline-primary ms-2" href="{{ route('customer.order.index', ['order_status' => '0']) }}">View All</a>
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
                                                    $paymentStatusClass = 'bg-warning-soft';
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
                                                    $orderStatusClass = 'bg-warning-soft';
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
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
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
