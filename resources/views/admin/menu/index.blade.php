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
              <!-- Buttons -->
              <a href="{{ route('menu.import') }}" class="btn btn-outline-dark ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Import Menu">
                <span class="fe fe-upload"></span>
              </a>
              <a href="{{ route('menu.export') }}" class="btn btn-outline-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Export Menu">
                <span class="fe fe-download"></span>
                <a href="{{ route('menu.create') }}" class="btn btn-primary ms-2"> Create Menu
                </a>
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
                      <a class="list-sort text-muted" data-sort="item-name" >S/N</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Thumnail</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title" >Name</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Category</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-name" >Price</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title" >Status</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title" >Action</a>
                    </th>
                  </tr>
                </thead>
                <tbody class="list fs-base">
                    @if ($menues->isEmpty())
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td  class="item-name h4 text-center">Menue List is Empty!</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($menues as $item)
                        <tr>
                            <td>
                            {{ $loop->index + 1 }}
                            </td>
                            <td>
                            <!-- Avatar -->
                            <div class="avatar avatar-sm align-middle me-2">
                                <img class="avatar-img rounded" src="{{ (!empty($item->thumbnail)) ? url('uploads/menu_images/'.$item->thumbnail)
                                : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}">
                            </td>
                            <td>

                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->name }}</a>

                            </td>
                            <td>

                            <!-- Text -->
                            <a class="item-name text-reset">{{ $item->category->name }}</a>

                            </td>
                            <td>

                            <!-- Price -->
                            </div> <a class="item-name text-reset">#{{ $item->price }}</a>

                            </td>
                            <td>

                            <!-- Status Badge -->
                            <span class="item-score badge {{ $item->status == 1 ? ' bg-success-soft':'bg-danger-soft' }}">{{ $item->status == 1 ? 'Published':'Draft' }}</span>

                            </td>
                            <td>
                            <div class="d-flex align-items-center ">
                                <span style="margin-right: 5px" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="View">
                                    <!-- Button -->
                                    <a class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalMenuDetails{{ $item->id }}">
                                        <span class="fe fe-eye"></span>
                                    </a>
                                </span>
                                @php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                                @endphp
                                <!-- Modal: Menu Details -->
                                <div class="modal fade" id="modalMenuDetails{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalMenuDetails{{ $item->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content bg-lighter">
                                    <div class="modal-body">

                                        <!-- Header -->
                                        <div class="row">
                                        <div class="col">
                                            <!-- Prettitle -->
                                            <h6 class="text-uppercase text-muted mb-3"><a href="#!" class="text-reset">Overview</a></h6>
                                            <!-- Title -->
                                            <h2 class="mb-2">Menu Details</h2>
                                        </div>
                                        <div class="col-auto">
                                            <!-- Close -->
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        </div> <!-- / .row -->

                                        <!-- Divider -->
                                        <hr class="my-3">

                                        <div class="row">
                                        <div class="col-12 col-md-5">
                                            <div class="card">
                                            <div class="card-body text-center">

                                                <!-- Image -->
                                                <a href="project-overview.html" class="img-fluid">
                                                <img src="{{ (!empty($item->thumbnail)) ? url('uploads/menu_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}" class="avatar-img rounded" style="max-width: 67%; ">
                                                </a>

                                                <div class="row p-4">
                                                <!-- Prettitle -->
                                                <h6 class="text-uppercase text-muted mb-3"><a href="#!" class="text-reset">Menu Name</a></h6>
                                                <!-- Heading -->
                                                <h2 class="card-title mb-2">{{ $item->name }}</h2>
                                                <h4 class="fw-normal mb-2">{{ $item->code }}</h4>
                                                <!-- Barcode -->
                                                <span style="display: flex; justify-content: center;">{!! $generator->getBarcode($item->code,$generator::TYPE_CODE_128) !!}</span>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-7">
                                            <div class="card">
                                            <!-- Body -->
                                            <div class="card-body">
                                                <!-- Features -->
                                                <div class="mb-3">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Category</h4>
                                                            <h4 class="fw-normal mb-1">{{ $item->category->name }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Menu Status</h4>
                                                            <h4 class="fw-normal mb-1"><span class="item-score badge {{ $item->status == 1 ? ' bg-success-soft' : 'bg-danger-soft' }}">{{ $item->status == 1 ? 'Published' : 'Draft' }}</span></h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Description</h4> <h4 class="fw-normal mb-1" style="max-width: 270px; white-space: pre-line;">{{ $item->description }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Price</h4>
                                                            <h4 class="fw-normal mb-1">#{{ $item->price }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Product Code </h4> <h4 class="fw-normal mb-1"> {{ $item->code }}</h4>
                                                        </li>
                                                        <li class="list-group-item d-flex align-items-center justify-content-between px-0">
                                                            <h4 class="fw-normal mb-1">Product BarCode </h4> <h4 class="fw-normal mb-1">{!! $generator->getBarcode($item->code,$generator::TYPE_CODE_128)  !!}</h4>
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

                                @if(Auth::user()->can('menu.edit'))
                                <span style="margin-right: 5px">
                                    <!-- Button -->
                                    <a class="btn btn-outline-primary btn-sm" href="{{ route('menu.edit', $item->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit">
                                    <span class="fe fe-edit"></span>
                                    </a>
                                </span>
                                @endif
                                @if(Auth::user()->can('menu.destroy'))
                                <form method="POST" action="{{ route('menu.destroy', $item->id) }}" data-confirm-delete="true" data-id="{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <!-- Button to trigger deletion -->
                                <button type="submit" class="btn btn-outline-danger btn-sm delete-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                    <span class="fe fe-trash-2"></span>
                                </button>
                                </form>
                            </div>
                            @endif
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
                      text: 'Menu Item has been deleted successfully!',
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
