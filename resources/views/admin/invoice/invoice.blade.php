<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @php
        $general = \App\Models\General::latest('created_at')->first();
    @endphp

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}" type="image/x-icon"/>

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/theme.bundle.css') }}" />

    <title>Invoice</title>
</head>
<body>
    <!-- Scroll Bar Style -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <style>
        ::-webkit-scrollbar {
           width: 10px;
        }
        ::-webkit-scrollbar-thumb {
          border-radius: 30px;
          background: -webkit-gradient(linear,left top,left bottom,from(#e6e6e6),to(#cacaca));
          }
        ::-webkit-scrollbar-track {
          background-color: #fff;
          border-radius:10px;
        }
    </style>

    @php
    $general = \App\Models\General::latest('created_at')->first();
    @endphp

    <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <!-- Content -->
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="card card-body p-5">
                        <div class="row">
                            <div class="col text-center">
                            <!-- Logo -->
                            <img class="img-fluid mb-4" style="max-width: 10rem;" src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo.png') }}" class="navbar-brand-img mx-auto" alt="...">
                            <!-- Title -->
                            <h2 class="mb-2">
                                 {{$general ? $general->company_name:'RAS'}} Invoice
                            </h2>
                            <!-- Text -->
                            <p class="text-muted mb-6">
                                Invoice ID <span>{{ $order->reference }}</span>
                            </p>
                            </div>
                        </div> <!-- / .row -->
                        <div class="row mb-4">
                            <div class="col-12 col-md-6">
                                <!-- Heading -->
                                <h6 class="text-uppercase text-muted">
                                    Invoiced to
                                </h6>
                                <!-- Text -->
                                <p class="text-muted mb-2">
                                    Customer Name: <strong class="text-body">{{ $customer->name }}</strong> <br>
                                </p>
                                <p class="text-muted mb-2">
                                    Phone Number : <strong class="text-body">{{ $customer->email }}</strong><br>
                                </p>
                                <p class="text-muted mb-2">
                                    Order Date: <strong class="text-body">{{ $order->transaction_date }}</strong><br>
                                </p>
                                <p class="text-muted mb-2">
                                    Order Status : <span class="item-score badge bg-success-soft">Paid</span><br>
                                </p>
                                <p class="text-muted mb-2">
                                    Order Reference : <strong class="text-body">{{ $order->reference }}</strong>
                                </p>
                            </div>
                            <div class="col-12 col-md-6 text-md-end">
                                <!-- Heading -->
                                <h6 class="text-uppercase text-muted">
                                    Invoiced from
                                </h6>
                                <!-- Text -->
                                <p class="text-muted mb-2">
                                    Company Name: <strong class="text-body">{{ $general ? $general->company_name:'RAS' }} </strong> <br>
                                </p>
                                <p class="text-muted mb-2">
                                    Address: <strong class="text-body">{{ $general ? $general->address:'RAS Address' }} </strong><br>
                                </p>
                                <p class="text-muted mb-2">
                                    Phone Number : <strong class="text-body">{{ $general ? $general->primary_phone:'080 RAS0 0000' }} </strong>
                                </p>
                            </div>
                        </div> <!-- / .row -->
                        <div class="row">
                            <div class="col-12">

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table my-4">
                                <thead>
                                    <tr>
                                        <th class="text-muted">S/N</th>
                                        <th class="text-muted">Name</th>
                                        <th class="text-muted text-end">Qty</th>
                                        <th class="text-muted text-end">Unit Cost</th>
                                        <th class="text-muted text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderdetails as $key=> $item)
                                    <tr>
                                        <td>
                                          {{ $loop->index + 1 }}
                                        </td>
                                        <!-- Text -->
                                        <td class="px-0">{{ $item->item_name }}</td>
                                        <!-- Text -->
                                        <td class="pr-4 text-end">{{ $item->quantity }}</td>
                                        <!-- Text -->
                                        <td class="pr-4 text-end">{{ $item->price }}</td>
                                        <!-- Text -->
                                        <td class="pr-4 text-end">{{ $item->price*$item->quantity }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="px-3 border-top border-top-2">
                                            Subtotal Amount
                                        </td>
                                        <td colspan="4" class="px-3 text-end border-top border-top-2">#{{ $order->subtotal }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3">
                                            Tax (VAT included)
                                        </td>
                                        <td colspan="4" class="px-3 text-end">#{{ Cart::tax() }}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 border-bottom border-bottom-3 border-top border-top-3 h3">
                                            <strong>Total Amount</strong>
                                        </td>
                                        <td colspan="4" class="px-3 text-end border-bottom border-bottom-3 border-top border-top-3">
                                            <span class="h3">
                                            #{{ $order->total}}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <hr class="my-5">

                            <!-- Title -->
                            <h6 class="text-uppercase">
                                Notes
                            </h6>

                            <!-- Text -->
                            <p class="text-muted mb-0">
                                We really appreciate your business and if there’s anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it’s super easy since this is a template, so just ask!
                            </p>

                            </div>
                        </div> <!-- / .row -->
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div> <!-- / .row -->
    </div>

    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('backend/assets/js/theme.bundle.js') }}"></script>

     <!-- Sweetalert included -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
