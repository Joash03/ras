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
              <a href="{{ route('category.import') }}" class="btn btn-outline-dark ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Import Category">
                <span class="fe fe-upload"></span>
              </a>
              <a href="{{ route('category.export') }}" class="btn btn-outline-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Export Category">
                <span class="fe fe-download"></span>
              </a>
              <a href="{{ route('category.create') }}" class="btn btn-primary ms-2"> Create Category </a>
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
                      <a class="list-sort text-muted" data-sort="item-name">Thumnail</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Name</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Type</a>
                    </th>
                    <th>
                      <a class="list-sort text-muted" data-sort="item-title">Action</a>
                    </th>
                  </tr>
                </thead>
                <tbody class="list fs-base">
                    @if ($categories->isEmpty())
                        <tr>
                            <td></td>
                            <td></td>
                            <td  class="item-name h4 text-center">Category List is Empty!</td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                    @foreach ($categories as $item)
                    <tr>
                        <td>
                        {{ $loop->index + 1 }}
                        </td>
                        <td>
                        <!-- Avatar -->
                        <div class="avatar avatar-sm align-middle me-2">
                            <img class="avatar-img rounded" src="{{ (!empty($item->thumbnail)) ? url('uploads/category_images/'.$item->thumbnail)
                            : url('uploads/no_image.jpg') }}" alt="{{ $item->name }}">
                        </td>
                        <td>
                        <!-- Text -->
                        <a class="item-name text-reset">{{ $item->name }}</a>
                        </td>
                        <td>
                        <!-- Type Badge -->
                        @php
                            $typeClass = '';
                            $typeText = '';
                            if ($item->type === 0) {
                                $typeClass = 'bg-info-soft';
                                $typeText = 'Menu';
                            } elseif ($item->type === 1) {
                                $typeClass = 'bg-dark-soft';
                                $typeText = 'Product';
                            } elseif ($item->type === 2) {
                                $typeClass = 'bg-danger-soft';
                                $typeText = 'Blog';
                            } elseif ($item->type === 3) {
                                $typeClass = 'bg-success-soft';
                                $typeText = 'Store';
                            }
                        @endphp
                        <span class="item-score badge {{ $typeClass }}">{{ $typeText }}</span>
                        </td>
                        <td>
                        <div class="d-flex align-items-center ">
                            @if(Auth::user()->can('category.edit'))
                            <span style="margin-right: 5px">
                                <!-- Button -->
                                <a class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Edit" href="{{ route('category.edit', $item->id) }}">
                                    <span class="fe fe-edit"></span>
                                </a>
                            </span>
                            @endif
                            @if(Auth::user()->can('category.destroy'))
                            <form method="POST" action="{{ route('category.destroy', $item->id) }}" data-confirm-delete="true"
                                data-id="{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <!-- Button to trigger deletion -->
                                <button type="submit" class="btn btn-outline-danger btn-sm delete-button" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Delete">
                                    <span class="fe fe-trash-2"></span>
                                </button>
                            </form>
                            @endif
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
              confirmButtonColor: '#ED1C24',
              cancelButtonColor: '#CE7F36',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  // If confirmed, submit the form
                  form.submit();
                  Swal.fire({
                      title: 'Success',
                      text: 'Category has been deleted successfully!',
                      icon: 'success',
                      showConfirmButton: true,
                      confirmButtonColor: '#CE7F36'
                  });
              }
              else {
                  // If cancel button is clicked, show a cancel message
                  Swal.fire({
                      title: 'Cancelled',
                      text: 'Delete action has been cancelled!',
                    icon: 'info',
                    showConfirmButton: true,
                    confirmButtonColor: '#CE7F36'
                  });
              }
          });
      });
  });
</script>

@endsection
