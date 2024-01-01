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
              <h6 class="header-pretitle"> New </h6>
              <!-- Title -->
              <h1 class="header-title">Create a new Blog</h1>
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
              <form class="mb-4" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                      <!-- Blog title -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">Blog Title</label>
                          <!-- Input -->
                          <input type="text" class="form-control" name="title">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Blog category -->
                        <div class="form-group">
                          <!-- Label  -->
                          <label class="form-label">Selete Blog Category</label>
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
                </div> <!-- / .row -->

                <!-- Blog description -->
                <div class="form-group">
                    <!-- Label -->
                    <label class="form-label mb-1">Blog content</label>
                    <!-- Textarea -->
                    <textarea id="editor" name="content" class="form-control"></textarea>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                       <!-- Blog cover -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label mb-1" for="thumbnailCreate">Blog Thumbnail</label>
                        <!-- Input -->
                        <input class="form-control" type="file" id="thumbnailCreate" name="thumbnail" accept="image/*">
                        <!-- Image preview -->
                        <img src="{{ asset('uploads/no_image.jpg') }}" alt="thumbnail" id="showThumbnailCreate" style="max-width: 15%; padding-top: 10px; display: none;">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Status Button toggle -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Blog status</label>
                        <div class="btn-group-toggle">
                            <input type="radio" class="btn-check" name="status" id="publish" value="1" checked>
                            <label class="btn btn-white" for="publish">
                                <i class="fe fe-check-circle"></i> Publish Blog
                            </label>

                            <input type="radio" class="btn-check" name="status" id="draft" value="0">
                            <label class="btn btn-white" for="draft">
                                <i class="fe fe-check-circle"></i> Save to Draft
                            </label>
                        </div>
                      </div>
                    </div>
                </div> <!-- / .row -->


                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Create Blog
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

    function validateForm() {
        var categoryId = document.getElementsByName('category_id')[0].value;
        var title = document.getElementsByName('title')[0].value;
        var thumbnail = document.getElementsByName('thumbnail')[0].value;
        var content = document.getElementsByName('content')[0].value;
        var status = document.querySelector('input[name="status"]:checked').value;

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

        if (title === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Title field is required!',
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

        if (content === '') {
            // Display SweetAlert error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Content field is required!',
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
