@extends('frontend.layouts.frontend')
@section('title', 'Checkout')

@php
$general = \App\Models\General::latest('created_at')->first();
@endphp

@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>CheckOut</h1>
        <p>Cooking delicious and tasty food since</p>
    </div>
@endsection
@section('content')
    <form id="makePaymentForm" action="{{ route('order',auth()->check() ? auth()->user()->id : null) }}" method="POST">
        @csrf
        <div class="pattern_2" style="transform: none;">
            <div class="container margin_60_40" style="transform: none;">
                <div class="row justify-content-center" style="transform: none;">
                    <div class="col-xl-6 col-lg-8">
                        <div class="box_booking_2 style_2" style="{{ auth()->user() ? 'display: none;' : '' }}">
                            <div class="head">
                                <div class="title">
                                    <h3>Personal Details</h3>
                                </div>
                            </div>
                            <div class="main">
                                <div class="form-group">
                                    <label>First and Last Name</label>
                                    <input required class="form-control" placeholder="First and Last Name" id="name" type="text" name="name" value="{{ $orderuser ? $orderuser->name:'' }}">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input required class="form-control" placeholder="name@address.com" id="email" type="email" name="email" value="{{ $orderuser ? $orderuser->email:'' }}" autocomplete="email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input required class="form-control" placeholder="Phone" name="phone" id="phone" type="tel" value="{{ $orderuser ? $orderuser->phone:'' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Full Address</label>
                                    <input required class="form-control" placeholder="Full Address" name="address" type="text" value="{{ $orderuser ? $orderuser->address:'' }}">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input required class="form-control @error('password') is-invalid @enderror" placeholder="Enter Password" type="password" id="password" name="password" placeholder="Enter your password">
                                            @error('password')<span class="text-danger"> {{ $message }} </span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input required class="form-control" placeholder="Confirm Password" id="password_confirmation" type="password" name="password_confirmation">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input class="form-control" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input class="form-control" placeholder="0123">
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="box_booking_2 style_2">
                            <div class="head">
                                <div class="title">
                                    <h3>Payment Method</h3>
                                </div>
                            </div>
                            <div class="main">
                                {{-- <div class="payment_select" id="flutterwave" style="display:flex;">
                                    <label class="container_radio" style="display:flex;">Pay via Flutterwave
                                        <input type="radio" value="1" name="payment_method" checked>
                                        <span class="checkmark"></span>
                                        <img style="margin-left: auto" src="{{ asset('frontend/img/pay_1.png') }}" width="5%" alt="pay_1.png">
                                    </label>
                                </div> --}}
                                <div class="payment_select" id="paystack">
                                    <label class="container_radio" style="display:flex;">Pay via Paystack
                                        <input type="radio" value="2" name="payment_method">
                                        <span class="checkmark"></span>
                                        <img style="margin-left: auto" src="{{ asset('frontend/img/pay_2.png') }}" width="5%" alt="pay_2.png">
                                    </label>
                                </div>
                                <div class="payment_select" id="dbt" style="display:flex;">
                                    <label class="container_radio" style="display:flex;">Pay via Direct Bank Transfer
                                        <input type="radio" value="3" name="payment_method">
                                        <span class="checkmark"></span>
                                        <img style="margin-left: auto" src="{{ asset('frontend/img/pay_3.png') }}" width="5%" alt="pay_3.png">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4" id="sidebar_fixed" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
                        <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 790.172px;">
                            <div class="box_booking">
                                <div class="head">
                                    <h3>Order Summary</h3>
                                </div>
                                <div class="main">
                                    <ul class="clearfix">
                                        @if (!empty($carts))
                                        @php
                                            $totalsubTotal = 0;
                                        @endphp

                                        @foreach ($carts as $cart)
                                        @php
                                            $menuThumbnail = $cart->item_type === 'menu' && $cart->menu ? $cart->menu->thumbnail : null;
                                            $productThumbnail = $cart->item_type === 'product' && $cart->product ? $cart->product->thumbnail : null;

                                            $subTotal = $cart->item_type === 'menu' && $cart->menu && $cart->menu->price ? $cart->quantity * $cart->menu->price : ($cart->item_type === 'product' && $cart->product && $cart->product->sales_price ? $cart->quantity * $cart->product->sales_price : 0);

                                            $totalsubTotal += $subTotal;
                                        @endphp
                                        <li>
                                            <input type="hidden" name="item_id[]" value="{{ $cart->item_id }}">
                                            <input type="hidden" name="item_type[]" value="{{ $cart->item_type }}">
                                            <input type="hidden" name="item_name[]" value="{{ $cart->item_type === 'menu' && $cart->menu ? $cart->menu->name : ($cart->item_type === 'product' && $cart->product ? $cart->product->name : '') }}">
                                            <input type="hidden" name="quantity[]"  value="{{ $cart->quantity }}">
                                            <input type="hidden" name="price[]"  value="{{ $subTotal }}">
                                            <strong>
                                                {{ $cart->quantity }} X {{ $cart->item_type === 'menu' && $cart->menu ? $cart->menu->name : ($cart->item_type === 'product' && $cart->product ? $cart->product->name : '') }}
                                            </strong>
                                            <strong><span>#{{ $subTotal }}</span></strong>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <ul class="clearfix">
                                        <li>Subtotal<span>#{{ $totalsubTotal }}.00</span></li>
                                        <input type="hidden" name="subtotal" id="subtotal" value="{{ $totalsubTotal }}">
                                        <li>Delivery fee<span>#{{ $general ? $general->delivery_fee:'' }}.00</span></li>
                                        <li class="text-dark h5">Total<span>#{{ $general ? ($general->delivery_fee + $totalsubTotal):$totalsubTotal }}.00</span></li>
                                        <input type="hidden" name="total" id="total" value="{{ $general ? ($general->delivery_fee + $totalsubTotal):$totalsubTotal }}">

                                        <input type="hidden" name="transaction_date" id="transaction_date" value="">
                                        <input type="hidden" name="payment_channel" id="payment_channel" value="">
                                        <input type="hidden" name="month" id="month" value="{{ date('F') }}">
                                        <input type="hidden" name="payment_reference" id="payment_reference" value="">
                                        <input type="hidden" name="status" id="status" value="">

                                    </ul>
                                    <button type="submit" id="orderButton" class="btn_1 full-width mb_5">Order Now</button>
                                    <div class="text-center">
                                        <small>Or Call Us at <strong>{{ $general ? $general->primary_phone:'' }}</strong></small>
                                    </div>
                                </div>
                            </div>
                            <div class="resize-sensor" style="position: absolute; inset: 0px; overflow: hidden; z-index: -1; visibility: hidden;">
                                <div class="resize-sensor-expand" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                    <div style="position: absolute; left: 0px; top: 0px; transition: all 0s ease 0s; width: 437px; height: 1120px;">
                                    </div>
                                </div>
                                <div class="resize-sensor-shrink" style="position: absolute; left: 0; top: 0; right: 0; bottom: 0; overflow: hidden; z-index: -1; visibility: hidden;">
                                    <div style="position: absolute; left: 0; top: 0; transition: 0s; width: 200%; height: 200%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
	<div class="modal fade" id="bankTransferModal" tabindex="1" aria-labelledby="bankTransferModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md">
			<div class="modal-content px-5 pb-3 pt-1">
				<div class="modal-header border-0 pb-0">
					<button type="button" class="btn-close"-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<div class="col-12">
						<div class="main_title text-center m-0">
                            <h1 class="m-0">Account Details</h1>
						</div>
                        <p class="text-center mb-3">Pay Via Direct Bank Transfer</p>
                        <div class="text-center">
							<div class="form-group mb-2">
                                <h6 class="m-0">Account Name</h6>
                                <h4><span>{{ $general ? $general->account_name:'' }}AAA BBB CCC</span></h4>
							</div>
							<div class="form-group mb-2">
                                <h6 class="m-0">Account Number</h6>
                                <h4><span>{{ $general ? $general->account_number:"" }}001122334455</span></h4>
							</div>
							<div class="form-group mb-2">
                                <h6 class="m-0">Bank Name</h6>
                                <h4><span>{{ $general ? $general->bank_name:'' }}ABCD Bank</span></h4>
							</div>
                            <div class="text-center">
                                <h2 class="m-0"><span>Total Amount: #{{ $general ? ($general->delivery_fee + $totalsubTotal):$totalsubTotal }}</span></h2>
                                <p>Only <strong>Click</strong> the <strong>Button</strong> below after you have <Strong>Transferred the Total Amount Above</Strong></p>
                                <a class="btn_1" name="payment_made" id="payment_made">Payment Made</a>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>


    <!-- Include Flutterwave library -->
    {{-- <script src="https://checkout.flutterwave.com/v3.js"></script> --}}

    <script>
        $(document).ready(function() {
            // Initial execution based on the default checked radio button
            var selectedPaymentMethod = $("input[name='payment_method']:checked").val();
            var orderButton = $("#orderButton");

            if (selectedPaymentMethod == 1) {
                orderButton.attr("onclick", "payWithFlutterwave(event)");
            } else if (selectedPaymentMethod == 2) {
                orderButton.attr("onclick", "payWithPaystack(event)");
            } else if (selectedPaymentMethod == 3) {
            }

            // Add an event listener to the radio buttons
            $('input[name="payment_method"]').on('change', function() {
                selectedPaymentMethod = $("input[name='payment_method']:checked").val();

                // if no payment method is selected, show an error message
                if (selectedPaymentMethod == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Select a Payment Method!',
                    });
                } else if (selectedPaymentMethod == 1) {
                    orderButton.attr("onclick", "payWithFlutterwave(event)");
                } else if (selectedPaymentMethod == 2) {
                    orderButton.attr("onclick", "payWithPaystack(event)");
                } else if (selectedPaymentMethod == 3) {
                    orderButton.attr("onclick", "payWithDBT(event)");
                }
            });
        });

        function payWithDBT(e) {
            e.preventDefault();
            var bankTransferModal = $("#bankTransferModal");

            bankTransferModal.modal("show");

            $("#payment_made").on("click", function() {
                bankTransferModal.modal("hide");
                Swal.fire({
                icon: 'success',
                title: 'Wait for Payment Verifaction!',
                });

                var currentDate = new Date();
                var formattedDate = currentDate.toISOString().slice(0, 19).replace('T', ' ');
                let reference = 'RAS_' + Math.floor(100000 + Math.random() * 900000).toString() + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26));

                // Access the properties from responseData object
                document.getElementById('transaction_date').value = formattedDate;
                document.getElementById('payment_channel').value = 'dbt';
                document.getElementById('payment_reference').value = reference;
                document.getElementById('status').value = 2;

                makePaymentForm.submit();
            });
        }

        function payWithPaystack(e) {
            e.preventDefault();
            let reference = 'RAS_' + Math.floor(100000 + Math.random() * 900000).toString() + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26));
            let handler = PaystackPop.setup({
                key: 'pk_test_4c59081dfff99e262077e96e44268ae22085203e',
                first_name:"name",
                email: document.getElementById("email").value,
                phone:"phone",
                amount: document.getElementById("total").value * 100,
                ref: reference,
                label: document.getElementById("name").value,
                onClose: function(){
                alert('Window closed.');
                },
                callback: function(response){
                let reference = response.reference;
                $.ajax({
                    type:"GET",
                    url: "{{ URL::to('order/verify') }}/" + reference,
                    success: function(response){
                        if (response[0].status === true) {
                            var responseData = response[0].data;

                            Swal.fire({
                                icon: 'success',
                                title: 'Payment Verification Successful!',
                            });

                            // Access the properties from responseData object
                            document.getElementById('transaction_date').value = JSON.stringify(responseData.transaction_date);
                            document.getElementById('payment_channel').value = JSON.stringify(responseData.channel);
                            document.getElementById('payment_reference').value = JSON.stringify(responseData.reference);
                            document.getElementById('status').value = JSON.stringify(responseData.status);

                            makePaymentForm.submit();
                        }
                        else
                        {
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Payment Verification Failed!',
                            });
                        }
                    }
                });
                }
            });

            handler.openIframe();
        }

        // function payWithFlutterwave(e) {
        //     e.preventDefault();
        //     let reference = 'RAS_' + Math.floor(100000 + Math.random() * 900000).toString() + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26));
        //     FlutterwaveCheckout({
        //         public_key: "FLWPUBK_TEST-375607d37ce2d460fa6ac4296152a607-X",
        //         tx_ref: reference,
        //         amount:  document.getElementById("total").value,
        //         currency: "NGN",
        //         payment_options: "card, banktransfer, ussd",
        //         customer: {
        //             email:  document.getElementById("email").value,
        //             phone_number:  document.getElementById("phone").value,
        //             name:  document.getElementById("name").value,
        //         },
        //         customizations: {
        //             title: "{{ $general ? $general->company_name : 'RAS' }}",
        //             description: "{{ $general ? $general->company_name : 'RAS' }} Order Payment",
        //             logo: "{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/favicon.ico') }}",
        //         },
        //     });
        // }
    </script>

@endsection
@section('scripts')
    <script src="{{ asset('frontend/js/sticky_sidebar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/shop_order_func.js') }}"></script>

    <!-- Include Paystack library -->
    <script src="https://js.paystack.co/v1/inline.js"></script>

@endsection
