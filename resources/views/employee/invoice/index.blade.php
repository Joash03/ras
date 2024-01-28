@extends('employee.employee_dashboard')

@section('employee')

@php
$general = \App\Models\General::latest('created_at')->first();
@endphp

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
                <h1 class="header-title">
                    {{ $page_title }}
                </h1>

              </div>
              <div class="col-auto">
                <!-- Buttons -->
                <button id="printButton" class="btn btn-outline-dark ms-2"data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Print Invoice">
                    <span class="fe fe-printer"></span>
                </button>
                <button id="downloadButton" class="btn btn-outline-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Download Invoice">
                    <span class="fe fe-download"></span>
                </button>
              </div>
            </div> <!-- / .row -->
          </div>
        </div>

        <!-- Content -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="bg-white p-5">
                    <div class="row">
                        <div class="col text-center">
                        <!-- Logo -->
                        <img class="img-fluid mb-4" style="max-width: 10rem;" src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo.png') }}" class="navbar-brand-img mx-auto" alt="...">
                        <!-- Title -->
                        <h2 class="mb-2">
                             {{$general ? $general->company_name:'RAS'}} Invoice
                        </h2>
                        <!-- Text -->
                        <p class="text mb-4">
                            Invoice ID <span>{{ $order->reference }}</span>
                        </p>
                        </div>
                    </div> <!-- / .row -->
                    <div class="row mb-4">
                        <div class="col-12 col-md-6">
                            <!-- Heading -->
                            <h6 class="text-uppercase text">
                                Invoiced to
                            </h6>
                            <!-- Text -->
                            <p class="text mb-2">
                                Customer Name: <strong class="text-body">{{ $employee->name }}</strong> <br>
                            </p>
                            <p class="text mb-2">
                                Phone Number : <strong class="text-body">{{ $employee->email }}</strong><br>
                            </p>
                            <p class="text mb-2">
                                Payment Date: <strong class="text-body">{{ $order->transaction_date }}</strong><br>
                            </p>
                            <!-- Payment Status Badge -->
                            @php
                                $paymentStatusClass = '';
                                $paymentStatusText = '';
                                if ($order->payment_status === 2) {
                                    $paymentStatusClass = 'bg-info-soft';
                                    $paymentStatusText = 'Pending';
                                } elseif ($order->payment_status === 1) {
                                    $paymentStatusClass = 'bg-success-soft';
                                    $paymentStatusText = 'Success';
                                } elseif ($order->payment_status === 0) {
                                    $paymentStatusClass = 'bg-danger-soft';
                                    $paymentStatusText = 'Failed';
                                }
                            @endphp
                            <p class="text mb-2">
                                Payment Status : <span class="item-score badge {{ $paymentStatusClass }}">{{ $paymentStatusText }}</span><br>
                            </p>
                        </div>
                        <div class="col-12 col-md-6 text-md-end">
                            <!-- Heading -->
                            <h6 class="text-uppercase text">
                                Invoiced from
                            </h6>
                            <!-- Text -->
                            <p class="text mb-2">
                                Company Name: <strong class="text-body">{{ $general ? $general->company_name:'RAS' }} </strong> <br>
                            </p>
                            <p class="text mb-2">
                                Address: <strong class="text-body">{{ $general ? $general->address:'RAS Address' }} </strong><br>
                            </p>
                            <p class="text mb-2">
                                Phone Number : <strong class="text-body">{{ $general ? $general->primary_phone:'080 RAS0 0000' }} </strong>
                            </p>
                        </div>
                    </div> <!-- / .row -->
                    <div class="row">
                        <div class="col-12">

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table my-3">
                                <thead>
                                    <tr>
                                        <th class="text text-dark text-bold">S/N</th>
                                        <th class="text text-dark text-bold">Name</th>
                                        <th class="text text-dark text-bold text-end">Qty</th>
                                        <th class="text text-dark text-bold text-end">Unit Cost</th>
                                        <th class="text text-dark text-bold text-end">Total</th>
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
                                        <td colspan="3" class="px-3 border-top border-top-2">
                                            Subtotal Amount
                                        </td>
                                        <td colspan="3" class="px-3 text-end border-top border-top-2">#{{ $order->subtotal }}.00</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-3">
                                            Tax (VAT included)
                                        </td>
                                        <td colspan="3" class="px-3 text-end">#{{ Cart::tax() }}.00</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="px-3 border-bottom border-bottom-3 border-top border-top-3 h3">
                                            <strong>Total Amount</strong>
                                        </td>
                                        <td colspan="3" class="px-3 text-end border-bottom border-bottom-3 border-top border-top-3">
                                            <span class="h3">
                                            #{{ $order->total}}.00
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>

                            <div class="my-5"> </div>

                            <!-- Title -->
                            <h4 class="text-uppercase">
                                <strong>Notes</strong>
                            </h4>

                            <!-- Text -->
                            <p class="text mb-">
                                We really appreciate you doing business with us and if there’s anything else we can do, please let us know!
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

<!-- Include Js Library -->
<script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to print the content
        function printContent() {
            const contentDiv = document.querySelector('.container-fluid .bg-white');

            html2pdf().set({
                margin: 10,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            }).from(contentDiv).output('dataurlnewwindow');
        }

        // Function to download content as PDF
        function downloadPDF() {
            const contentDiv = document.querySelector('.container-fluid .bg-white');

            html2pdf(contentDiv, {
                margin: 10,
                filename: 'invoice.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            }).then((pdf) => {
                pdf.save();
            });
        }

        // Attach event listeners to the buttons
        document.getElementById('printButton').addEventListener('click', printContent);
        document.getElementById('downloadButton').addEventListener('click', downloadPDF);
    });
</script>


@endsection
