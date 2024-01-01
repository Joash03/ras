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
        if ($wizardstatus === 0) {
            $step1 = 'd-block';
            $step2 = 'd-none';
        } elseif ($wizardstatus === 1) {
            $step1 = 'd-none';
            $step2 = 'd-block';
        }
      @endphp
      <!-- Tab content -->
      <div class="tab-content pb-6">
        <div class="{{ $step1 }}">
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
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
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-outline-dark ms-2" href="{{ route('inventory.product.expiredproduct.edit') }}">Edit Product Date</a>
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
                            @if ($expiredproducts->isEmpty())
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td  class="item-name h4 text-center">Expired Products List is Empty!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                                @foreach ($expiredproducts as $item)
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
                                    <a class="item-name text-reset"><strong>{{ $item->purchase_date }}</strong></a>
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-danger"><strong>{{ $item->expiry_date }}</strong></a>
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
        <form class="tab-content {{ $step2 }}" action="{{ route('inventory.product.expiredproduct.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Card -->
            <div class="card" data-list='{"valueNames": ["item-name", "item-title", "item-email", "item-phone", "item-score", "item-company"], "page": 10, "pagination": {"paginationClass": "list-pagination"}}' id="contactsList">
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
                    <div class="col-auto">
                        <!-- Buttons -->
                        <a class="btn btn-outline-dark ms-2" onclick="resetPage()">Reset Input</a>
                        <button class="btn btn-outline-primary ms-2" type="submit">Update Product Date</button>
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
                            @if ($expiredproducts->isEmpty())
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td  class="item-name h4 text-center">Expired Products List is Empty!</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @else
                                @foreach ($expiredproducts as $item)
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
                                        <input type="date" name="purchase_date[{{ $item->id }}]" class="form-control flatpickr-input" data-flatpickr="" value="<?php echo date('Y-m-d'); ?>"></a>
                                    </td>
                                    <td>
                                    <!-- Text -->
                                    <a class="item-name text-reset">
                                        <input type="date" name="expiry_date[{{ $item->id }}]" class="form-control flatpickr-input" data-flatpickr="">
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
</script>

@endsection

