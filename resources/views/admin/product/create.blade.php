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
              <h6 class="header-pretitle">New</h6>
              <!-- Title -->
              <h1 class="header-title">Create New Product</h1>
            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      <!-- Tab content -->
      <div class="tab-content">
        <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">

          <div class="card">
            <div class="card-body">
              <!-- Form -->
              <form class="mb-4" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- Product name -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Product Name</label>
                        <!-- Input -->
                        <input type="text" class="form-control" name="name">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product price -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Purchase Price</label>
                        <!-- Input -->
                        <input type="text" name="purchase_price" class="form-control" placeholder="#0.00" >
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product date -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Purchase Date</label>
                        <!-- Input -->
                        <input type="date" name="purchase_date" id="purchase_date" class="form-control flatpickr-input" data-flatpickr="" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product price -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Sales Price</label>
                        <!-- Input -->
                        <input type="number" name="sales_price" id="sales_price" class="form-control" placeholder="#0.00" >
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product date -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Expiry Date</label>
                        <!-- Input -->
                        <input type="date" name="expiry_date" id="expiry_date" class="form-control flatpickr-input" data-flatpickr="">
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product category -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Selete  Product Category</label>
                      <!-- Input -->
                      <select name="category_id" id="category_id"  class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                          @foreach ($categories as $item)
                          {
                              "value": "{{ $item->id }}",
                              "label": "{{ $item->name }}",
                              "customProperties": {
                                  "avatarSrc": "{{ (!empty($item->thumbnail)) ? url('uploads/category_images/'.$item->thumbnail) : url('uploads/no_image.jpg') }}"
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
                    <!-- Product stock -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Product Stock</label>
                        <!-- Input -->
                        <input type="number" name="stock" id="stock" class="form-control" placeholder="0" >
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Product supplier -->
                    <div class="form-group">
                      <!-- Label  -->
                      <label class="form-label">Selete  Product Supplier</label>
                      <!-- Input -->
                      <select name="supplier_id" id="supplier_id"  class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                          @foreach ($suppliers as $item)
                          {
                              "value": "{{ $item->id }}",
                              "label": "{{ $item->name }}",
                              "customProperties": {
                                  "avatarSrc": "{{ (!empty($item->photo)) ? url('uploads/supplier_images/'.$item->photo) : url('uploads/no_image.jpg') }}"
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
                    <!-- Product description -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label mb-1">Product description</label>
                        <!-- Textarea -->
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <!-- Status Button toggle -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label">Product status</label>
                      <div class="btn-group-toggle">
                          <input type="radio" class="btn-check" name="status" id="publish" value="1" checked>
                          <label class="btn btn-white" for="publish">
                              <i class="fe fe-check-circle"></i> Publish Product
                          </label>

                          <input type="radio" class="btn-check" name="status" id="draft" value="0">
                          <label class="btn btn-white" for="draft">
                              <i class="fe fe-check-circle"></i> Save to Draft
                          </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                     <!-- Product cover -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1" for="thumbnailCreate">Product Thumbnail</label>
                      <!-- Input -->
                      <input class="form-control" type="file" id="thumbnailCreate" name="thumbnail" accept="image/*">
                      <!-- Image preview -->
                      <img src="{{ asset('uploads/no_image.jpg') }}" alt="thumbnail" id="showThumbnailCreate" style="max-width: 15%; padding-top: 10px; display: none;">
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Create Product
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div> <!-- / .row -->
</div>

<!-- JAVASCRIPT -->

<script>
  $(document).ready(function () {
        $('#thumbnailCreate').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailCreate').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
        // Initially display "no_image.jpg"
        $('#showThumbnailCreate').attr('src', '{{ asset('uploads/no_image.jpg') }}');
        $('#showThumbnailCreate').css('display', 'block');
  });

// Include this script in your HTML file or include it in your assets

function validateForm() {
    var categoryId = document.getElementsByName('category_id')[0].value;
    var supplierId = document.getElementsByName('supplier_id')[0].value;
    var name = document.getElementsByName('name')[0].value;
    var thumbnail = document.getElementsByName('thumbnail')[0].value;
    var purchaseDate = document.getElementsByName('purchase_date')[0].value;
    var expiryDate = document.getElementsByName('expiry_date')[0].value;
    var purchasePrice = document.getElementsByName('purchase_price')[0].value;
    var salesPrice = document.getElementsByName('sales_price')[0].value;
    var stock = document.getElementsByName('stock')[0].value;
    var status = document.getElementsByName('status')[0].value;

    // Validation checks
    if (categoryId === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Category field is required!',
        });
        return false; // Prevent form submission
    }

    if (supplierId === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Supplier field is required!',
        });
        return false; // Prevent form submission
    }

    if (name === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Name field is required!',
        });
        return false; // Prevent form submission
    }

    if (thumbnail === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Thumbnail field is required!',
        });
        return false; // Prevent form submission
    }

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(thumbnail)) {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid thumbnail file format! (Allowed formats: jpg, jpeg, png)',
        });
        return false; // Prevent form submission
    }

    if (purchaseDate === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Purchase date field is required!',
        });
        return false; // Prevent form submission
    }

    if (expiryDate === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Expiry date field is required!',
        });
        return false; // Prevent form submission
    }

    if (purchasePrice === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Purchase price field is required!',
        });
        return false; // Prevent form submission
    }

    if (salesPrice === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Sales price field is required!',
        });
        return false; // Prevent form submission
    }

    if (stock === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Stock field is required!',
        });
        return false; // Prevent form submission
    }

    if (status === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Status field is required!',
        });
        return false; // Prevent form submission
    }

    // If all checks pass, the form is valid
    return true;
}

</script>

@endsection
