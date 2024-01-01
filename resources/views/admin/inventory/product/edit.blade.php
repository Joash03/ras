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
              <h1 class="header-title text-truncate">
                {{ $page_title }}
              </h1>
            </div>

            <div class="col-auto">

            </div>
          </div> <!-- / .row -->
        </div>
      </div>
      @php
        $step1 = '';
        $step2 = '';
        $step3 = '';
        if ($wizardstatus === 0) {
            $step1 = 'd-block';
            $step2 = 'd-none';
            $step3 = 'd-none';
        } elseif ($wizardstatus === 1) {
            $step1 = 'd-none';
            $step2 = 'd-block';
            $step3 = 'd-none';
        } elseif ($wizardstatus === 2) {
            $step1 = 'd-none';
            $step2 = 'd-none';
            $step3 = 'd-block';
        }
      @endphp
      <!-- Tab content -->
      <div class="tab-content pb-6">
        <!-- Forms -->
        <form class="tab-content {{ $step1 }}" action="{{ route('inventory.product.update.one') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormStock();">
            @csrf
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 30, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
                <div class="card-header">
                <div class="nav row align-items-center">
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
                    <div class="col text-end">
                    <!-- Step -->
                    <h5 class="text-uppercase text-muted mb-0">Step 1 of 3</h5>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-outline-dark ms-2" onclick="resetPage()">Reset Input</a>
                        <button class="btn btn-outline-primary ms-2" type="submit">Next to Price</button>
                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >S/N</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Thumnail</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-title">Name</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Category</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Supplier</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-title">Present Stock</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name">New Stock</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list fs-base">
                    @foreach ($products as $item)
                    <tr>
                        <td>
                        {{ $loop->index + 1 }}
                        </td>
                        <td>
                        <!-- Avatar -->
                        <div class="avatar avatar-sm align-middle me-2">
                            <img class="avatar-img rounded" src="{{ (!empty($item->thumbnail)) ? url('uploads/product_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}">
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->name }}</a>
                        <input type="hidden" name="product_id[{{ $item->id }}]" class="form-control" placeholder="#0.00" value="{{ $item->id }}">
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->category->name }}</a>
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->supplier->name }}</a>
                        </td>
                        <td>
                        <!-- Stock -->
                        <a class="item-name text-reset"><strong>{{ $item->stock }}</strong>
                        </a>
                        </td>
                        <td>
                        <!-- Stock -->
                        <a class="item-name text-reset">
                            <input type="number" id="new_stock" name="new_stock[{{ $item->id }}]" class="form-control">
                        </a>
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
        </form>
        <form class="tab-content {{ $step2 }}" action="{{ route('inventory.product.update.two') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormPrice();">
            @csrf
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 30, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
                <div class="card-header">
                <div class="nav row align-items-center">
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
                    <div class="col text-end">
                        <!-- Step -->
                        <h5 class="text-uppercase text-muted mb-0">Step 2 of 3</h5>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-outline-dark ms-2" onclick="resetPage()">Reset Input</a>
                        <button class="btn btn-outline-primary ms-2" type="submit">Next to Date</button>
                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >S/N</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Thumnail</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-title">Name</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Category</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Supplier</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name">Purchcase Price</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name">Sales Price</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list fs-base">
                    @foreach ($products as $item)
                    <tr>
                        <td>
                        {{ $loop->index + 1 }}
                        </td>
                        <td>
                        <!-- Avatar -->
                        <div class="avatar avatar-sm align-middle me-2">
                            <img class="avatar-img rounded" src="{{ (!empty($item->thumbnail)) ? url('uploads/product_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}">
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->name }}</a>
                        <input type="hidden" name="product_id[{{ $item->id }}]" class="form-control" placeholder="#0.00" value="{{ $item->id }}">
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->category->name }}</a>
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->supplier->name }}</a>
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">
                            <input type="number" id="purchase_price" name="purchase_price[{{ $item->id }}]" class="form-control" placeholder="#0.00" value="{{ $item->purchase_price }}"></a>
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">
                            <input type="number" id="sales_price" name="sales_price[{{ $item->id }}]" class="form-control" placeholder="#0.00" value="{{ $item->sales_price }}"></a>
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
        </form>
        <form class="tab-content {{ $step3 }}" action="{{ route('inventory.product.update.three') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateFormDate();">
            @csrf
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 30, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
                <div class="card-header">
                <div class="nav row align-items-center" role="tablist">
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
                    <div class="col text-end">
                        <!-- Step -->
                        <h5 class="text-uppercase text-muted mb-0">Step 3 of 3</h5>
                    </div>
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-outline-dark ms-2" onclick="resetPage()">Reset Input</a>
                        <button class="btn btn-outline-primary ms-2" type="submit">Complete Product Inventory Update</button>
                    </div>
                </div> <!-- / .row -->
                </div>
                <div class="table-responsive">
                <table class="table table-sm table-hover table-nowrap card-table">
                    <thead>
                    <tr>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >S/N</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Thumnail</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-title">Name</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Category</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name" >Supplier</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name">Purchcase Date</a>
                        </th>
                        <th>
                        <a class="list-sort text-muted" data-sort="item-name">Expiry Date</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody class="list fs-base">
                        @if ($products->isEmpty())
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td  class="item-name h4 text-center">Product List is Empty!</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($products as $item)
                            <tr>
                                <td>
                                {{ $loop->index + 1 }}
                                </td>
                                <td>
                                <!-- Avatar -->
                                <div class="avatar avatar-sm align-middle me-2">
                                    <img class="avatar-img rounded" src="{{ (!empty($item->thumbnail)) ? url('uploads/product_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}">
                                </td>
                                <td>
                                <!-- Text -->
                                <a class="item-name text-reset">{{ $item->name }}</a>
                                <input type="hidden" name="product_id[{{ $item->id }}]" class="form-control" placeholder="#0.00" value="{{ $item->id }}">
                                </td>
                                <td>
                                <!-- Text -->
                                <a class="item-name text-reset">{{ $item->category->name }}</a>
                                </td>
                                <td>
                                <!-- Text -->
                                <a class="item-name text-reset">{{ $item->supplier->name }}</a>
                                </td>
                                <td>
                                <!-- Text -->
                                <a class="item-name text-reset">
                                    <input type="date" id="purchase_date" name="purchase_date[{{ $item->id }}]" class="form-control flatpickr-input" data-flatpickr="" value="<?php echo date('Y-m-d'); ?>"></a>
                                </td>
                                <td>
                                <!-- Text -->
                                <a class="item-name text-reset">
                                    <input type="date" id="expiry_date" name="expiry_date[{{ $item->id }}]" class="form-control flatpickr-input" data-flatpickr="">
                                </a>
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
        </form>
      </div>

    </div>
  </div> <!-- / .row -->
</div>


<script>
    function resetPage() {
        // Reload the current page
        location.reload();
    }

    function validateFormStock() {
        var new_stock = document.getElementById('new_stock').value;


        if (new_stock === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All Stock fields are required!',
            });
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    function validateFormPrice() {
        var purchase_price = document.getElementById('purchase_price').value;
        var sales_price = document.getElementById('sales_price').value;

        if (purchase_price === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All Purchase price fields are required!',
            });
            return false; // Prevent form submission
        }

        if (sales_price === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All Sales price fields are required!',
            });
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }

    function validateFormDate() {
        var expiry_date = document.getElementById('expiry_date').value;
        var purchase_date = document.getElementById('purchase_date').value;

        if (expiry_date === '' || purchase_date === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill all fields!',
            });
            return false; // Prevent form submission
        }
        if (expiry_date === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All Expiry date fields are required!',
            });
            return false; // Prevent form submission
        }

        if (purchase_date === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'All Purchase date fields are required!',
            });
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
</script>

@endsection

