@extends('admin.admin_dashboard')

@section('admin')

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-12 pb-5 mb-5">

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
                <a href="{{ route('menu.import') }}" class="btn btn-outline-dark ms-2">
                   <span class="fe fe-upload"></span> Import Menu
                </a>
                <a href="{{ route('product.import') }}" class="btn btn-outline-primary ms-2">
                    <span class="fe fe-upload"></span> Import Product
                </a>
            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      <!-- Tab content -->
      <div class="tab-content pb-5 mb-5">
        <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">
            <div class="row">
                <div class="col-12 col-md-7">
                  <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between align-items-center mt-2">
                          <div class="col">
                            <!-- Heading -->
                            <h2 class="mb-2">New Order Bill </h2>
                          </div>
                          <div class="col-auto">
                          </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Form -->
                        <form class="mb-4" action="{{ url('/pos/update/cart') }}" method="POST">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                  <thead>
                                    <tr>
                                      <th scope="list-sort text-muted">Name</th>
                                      <th scope="list-sort text-muted">Quantity</th>
                                      <th scope="list-sort text-muted">Price</th>
                                      <th scope="list-sort text-muted">Sub Total</th>
                                      <th scope="list-sort text-muted">Action</th>
                                    </tr>
                                  </thead>
                                  @php
                                  use Gloudemans\Shoppingcart\Facades\Cart;
                                  $allcart = Cart::content();
                                  @endphp
                                  <tbody class="list fs-base">
                                    @if ($allcart->isEmpty())
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td  class="item-name h4 text-center">Cart Empty!</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                    @foreach($allcart as $cart)
                                    <tr>
                                      <td class="item-name text-reset">{{ $cart->name }}</td>
                                      <td class="item-name text-reset">
                                        <input type="number" name="qty[{{ $cart->rowId }}]" class="form-control" value="{{ $cart->qty }}">
                                    </td>
                                      <td class="item-name text-reset">{{ $cart->price }}</td>
                                      <td class="item-name text-reset">{{ $cart->price*$cart->qty }}</td>
                                      <td>
                                        <!-- Button to trigger deletion -->
                                        <a type="submit" class="btn btn-outline-danger btn-sm cart-delete-button" href="{{ route('pos.remove', $cart->rowId) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                            <span class="fe fe-trash-2"></span>
                                        </a>
                                      </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                  </tbody>
                                </table>
                            </div>
                            <div class="row align-items-center mb-5 mt-1">
                              <div class="col">

                              </div>
                              <div class="col-auto">
                                  <!-- Buttons -->
                                  <button type="submit" class="btn btn-outline-dark ms-2">
                                    <span class="fe fe-refresh-cw"></span> Update Cart
                                  </button>
                                  <a href="{{ route('pos.empty') }}" class="btn btn-outline-danger ms-2 delete-button">
                                      <span class="fe fe-trash-2"></span> Empty Cart
                                  </a>
                              </div>
                            </div>
                            <!-- Features -->
                            <div class="mb-3">
                                <ul class="list-group list-group-flush text-bold">
                                  <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <h4 class="fw-normal mb-1">Quantity</h4> <h4 class="fw-normal mb-1">{{ Cart::count() }}</h4>
                                  </li>
                                  <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <h4 class="fw-normal mb-1">Subtotal</h4> <h4 class="fw-normal mb-1">#{{ Cart::subtotal() }}.00</h4>
                                  </li>
                                  <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <h4 class="fw-normal mb-1">Tax (VAT included)</h4> <h4 class="fw-normal mb-1">#{{ Cart::tax() }}.00</h4>
                                  </li>
                                  <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                    <h1 class="header-title text-truncate mb-1">Total</h1> <h1 class="header-title text-truncate mb-1">#{{ Cart::total() }}.00</h1>
                                  </li>
                                </ul>
                            </div>
                        </form>
                        <!-- Form -->
                        <form class="mb-4" action="{{ route('order.pos') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <!-- Customer -->
                                    <div class="form-group">
                                        <!-- Label  -->
                                        <label class="form-label">All Customer</label>
                                        <!-- Input -->
                                        <select name="customer_id" id="customer_id"  class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                                            @foreach ($customers as $item)
                                            {
                                                "value": "{{ $item->id }}",
                                                "selected": "{{ $item->id == '2' ? 'selected' : '' }}",
                                                "label": "{{ $item->name }}",
                                                "customProperties": {
                                                    "avatarSrc": "{{ (!empty($item->photo)) ? url('uploads/customer_images/'.$item->photo) : url('uploads/no_image.jpg') }}"
                                                }
                                            }
                                            @if (!$loop->last),
                                            @endif
                                            @endforeach
                                        ]}'>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <!-- Payment Method -->
                                    <div class="form-group">
                                        <!-- Label  -->
                                        <label class="form-label">Payment Method</label>
                                        <!-- Input -->
                                        <select name="payment_method" id="payment_method" class="form-select mb-3"  data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                                            {
                                                "value": "0",
                                                "selected": "selected",
                                                "label": "Cash",
                                                "customProperties": {
                                                    "avatarSrc": "{{ url('frontend/img/pay_0.png') }}"
                                                }
                                            },
                                            {
                                                "value": "4",
                                                "selected": "",
                                                "label": "Card",
                                                "customProperties": {
                                                    "avatarSrc": "{{ url('frontend/img/pay_4.png') }}"
                                                }
                                            }
                                        ]}'>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="transaction_date" id="transaction_date" value="{{ date('Y-m-d H:i:s') }}">
                                <input type="hidden" name="payment_channel" id="payment_channel" value="pos">
                                <input type="hidden" name="month" id="month" value="{{ date('F') }}">
                                <input type="hidden" name="payment_reference" id="payment_reference" value="">
                                <script>
                                    let reference = 'RAS_' + Math.floor(100000 + Math.random() * 900000).toString() + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26)) + String.fromCharCode(65 + Math.floor(Math.random() * 26));
                                    document.getElementById('payment_reference').value = reference;
                                </script>
                                <input type="hidden" name="payment_status" id="payment_status" value="1">
                                <input type="hidden" name="subtotal" id="subtotal" value="{{ Cart::subtotal() }}">
                                <input type="hidden" name="total" id="total" value="{{ Cart::total() }}">
                                <!-- Buttons -->
                                <div class="form-group">
                                    <button type="submit" class="btn w-100 btn-primary">
                                        <span class="fe fe-file-text"></span> Create Invoice
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="card">
                        <ul class="nav nav-tabs btn-md mt-2 px-3" id="tabs-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link ms-2 active" id="tabs-menu-tab" data-bs-toggle="pill" data-bs-target="#tabs-menu" type="button" role="tab" aria-controls="tabs-menu" aria-selected="true">Menu</button>
                            </li>
                            <li class="nav-item ms-2" role="presentation">
                              <button class="nav-link" id="tabs-product-tab" data-bs-toggle="pill" data-bs-target="#tabs-product" type="button" role="tab" aria-controls="tabs-product" aria-selected="false">Product</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="tabs-tabContent">
                            <div class="tab-pane fade show active" id="tabs-menu" role="tabpanel" aria-labelledby="tabs-menu-tab">
                                <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 6, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
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
                                              <a class="list-sort text-muted" data-sort="item-name">Menu</a>
                                            </th>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody class="list fs-base">
                                            @if ($menus->isEmpty())
                                                <tr>
                                                    <td  class="item-name h4 text-center">Menu List is Empty!</td>
                                                </tr>
                                            @else
                                            @foreach ($menus as $item)
                                            <tr>
                                                <!-- Form -->
                                                <form class="mb-4" action="{{ url('/pos/add/cart') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="price" value="{{ $item->price }}">
                                                    <input type="hidden" name="item_type" value="menu">
                                                    <input type="hidden" name="qty" value="1">
                                                    <td>
                                                        <div class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                            <!-- Avatar -->
                                                            <a href="project-overview.html" class="avatar avatar-md">
                                                                <img src="{{ (!empty($item->thumbnail)) ? url('uploads/menu_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}" class="avatar-img rounded">
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
                                                                    <button class="btn btn-outline-primary btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add to Cart">
                                                                        <span class="fe fe-plus"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div> <!-- / .row -->
                                                        </div>
                                                    </td>
                                                </form>
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
                            <div class="tab-pane fade" id="tabs-product" role="tabpanel" aria-labelledby="tabs-product-tab">
                                <div data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 6, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
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
                                              <a class="list-sort text-muted" data-sort="item-name" >Products</a>
                                            </th>
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody class="list fs-base">
                                            @if ($products->isEmpty())
                                                <tr>
                                                    <td  class="item-name h4 text-center">Product List is Empty!</td>
                                                </tr>
                                            @else
                                            @foreach ($products as $item)
                                            <tr>
                                                <!-- Form -->
                                                <form class="mb-4" action="{{ url('/pos/add/cart') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="hidden" name="name" value="{{ $item->name }}">
                                                    <input type="hidden" name="price" value="{{ $item->sales_price }}">
                                                    <input type="hidden" name="item_type" value="product">
                                                    <input type="hidden" name="qty" value="1">
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
                                                                    <button class="btn btn-outline-primary btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Add to Cart">
                                                                        <span class="fe fe-plus"></span>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        </div> <!-- / .row -->
                                                        </div>
                                                    </td>
                                                </form>
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
        $("#create_invoice").on("click", function(e) {
            // Prevent the default form submission
            e.preventDefault();
            bankTransferModal.modal("hide");
            Swal.fire({
            icon: 'success',
            title: 'Invoice created successfully!',
            });

            makePaymentForm.submit();
        });
    });
    $(document).ready(function () {
        // Handle form submission
        $('.cart-delete-button').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var link = $(this).attr('href'); // Get the link URL

            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to delete this item?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ED1C24',
                cancelButtonColor: '#CE7F36',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the payment confirmation URL
                    window.location.href = link;
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
    $(document).ready(function () {
        // Handle form submission
        $('.delete-button').click(function (e) {
            e.preventDefault(); // Prevent the default form submission

            var link = $(this).attr('href'); // Get the link URL

            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Delete Confirmation',
                text: 'Are you sure you want to empty cart?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ED1C24',
                cancelButtonColor: '#CE7F36',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, redirect to the payment confirmation URL
                    window.location.href = link;
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
