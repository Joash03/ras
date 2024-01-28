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
              <h1 class="header-title">Import Products</h1>
            </div>
            <div class="col-auto">
              <!-- Buttons -->
              {{-- <a href="{{ route('product.export') }}" class="btn btn-primary ms-2">
                Download Excel File
              </a> --}}
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
              <form class="mb-4" action="{{ route('product.import.store') }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                  <div class="col-12 col-md-6">
                     <!-- Product File -->
                    <div class="form-group">
                      <!-- Label -->
                      <label class="form-label mb-1" for="import_file">Import Excel File (Xlsx)</label>
                      <!-- Input -->
                      <input class="form-control" type="file" id="import_file" name="import_file" accept="file/*">
                    </div>
                  </div>
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Import Product
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
    function validateForm() {
            var import_file = document.getElementsByName('import_file')[0].value;

            if (import_file === '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select a file!',
                });
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
</script>

@endsection
