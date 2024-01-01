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
                Update
              </h6>

              <!-- Title -->
              <h1 class="header-title">
                Edit Product
              </h1>

            </div>
          </div> <!-- / .row -->
        </div>
      </div>

      <!-- Tab content -->
      <div class="tab-content">
        <div class="tab-pane fade show active" id="contactsListPane" role="tabpanel" aria-labelledby="contactsListTab">

          <div class="card">
            <div class="card-body">
            <form class="mb-4" action="{{ route('expense.update', $expense->id ) }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                      <!-- Expense details -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label mb-1">Expense details</label>
                          <!-- Textarea -->
                          <textarea name="details" class="form-control" rows="3">{{ $expense->details }}</textarea>
                      </div>
                    </div>
                  <div class="col-12 col-md-6">
                    <!-- Expense amount -->
                    <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Expense Amount</label>
                        <!-- Input -->
                        <input type="number" name="amount" class="form-control" placeholder="#0.00" value="{{ $expense->amount }}">
                    </div>
                  </div>
                  <!-- Input -->
                  <input type="hidden" name="id" value="{{ $expense->id }}">
                  <!-- Input -->
                  <input type="hidden" name="date" id="date" class="form-control" value="{{ $expense->date }}">
                  <!-- Input -->
                  <input type="hidden" name="month" id="month" class="form-control" value="{{ $expense->month }}">
                  <!-- Input -->
                  <input type="hidden" name="year" id="year" class="form-control" value="{{ $expense->year }}">
                </div> <!-- / .row -->

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update Expense
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
    var details = document.getElementsByName('details')[0].value;
    var amount = document.getElementsByName('amount')[0].value;

    // Validation checks
    if (details === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Details field is required!',
        });
        return false; // Prevent form submission
    }

    if (amount === '') {
        // Display SweetAlert error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Amount field is required!',
        });
        return false; // Prevent form submission
    }
    // If all checks pass, the form is valid
    return true;
}
</script>

@endsection
