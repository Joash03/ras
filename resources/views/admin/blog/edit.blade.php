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
              <h6 class="header-pretitle"> Update </h6>
              <!-- Title -->
              <h1 class="header-title">Edit Blog</h1>
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
                @csrf
              <form class="mb-4" action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                      <!-- Blog title -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">Blog Title</label>
                          <!-- Input -->
                          <input type="text" class="form-control" name="title"  value="{{ $blog->title }}">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Blog category -->
                        <div class="form-group">
                          <!-- Label  -->
                          <label class="form-label">Selete Blog Category</label>
                          <!-- Input -->
                          <select id="category_id" name="category_id" class="form-select mb-3" data-choices='{"searchEnabled": true, "allowHTML": true, "choices": [
                            @foreach ($categories as $item)
                                {
                                    "value": "{{ $item->id }}",
                                    "selected": "{{ $item->id == $blog->category_id ? 'selected' : '' }}",
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


                <!-- Blog content -->
                <div class="form-group">
                    <!-- Label -->
                    <label class="form-label mb-1">Blog content</label>
                    <!-- Textarea -->
                    <textarea id="editor" name="content" class="form-control">{{ $blog->content }}</textarea>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                       <!-- Blog cover -->
                       <div class="form-group">
                        <!-- Label -->
                        <label class="form-label mb-1" for="thumbnailEdit">Blog Thumbnail</label>
                        <!-- Input -->
                        <input class="form-control" type="file" id="thumbnailEdit" name="thumbnail" accept="image/*">
                        <!-- Image preview -->
                        <img class="avatar-img rounded" src="{{ (!empty($blog->thumbnail)) ? asset('uploads/blog_images/'.$blog->thumbnail) : asset('uploads/no_image.jpg') }}" alt="{{ $blog->name }}" id="showThumbnailEdit" style="max-width: 15%; padding-top: 10px; display: none;">
                       </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Status Button toggle -->
                      <div class="form-group">
                        <!-- Label -->
                        <label class="form-label">Blog Status</label>
                        <div class="btn-group-toggle">
                            <input type="radio" class="btn-check" name="status" id="publish" value="1" {{ $blog->status == 1 ? 'checked':'' }}>
                            <label class="btn btn-white" for="publish"><i class="fe fe-check-circle"></i> Publish Blog</label>

                            <input type="radio" class="btn-check" name="status" id="draft" value="0" {{ $blog->status == 0 ? 'checked':'' }}>
                            <label class="btn btn-white" for="draft"><i class="fe fe-check-circle"></i> Save to Draft</label>
                        </div>
                      </div>
                    </div>
                </div> <!-- / .row -->


                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update Blog
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
        $('#thumbnailEdit').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailEdit').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // // Initially display "no_image.jpg"
        $('#showThumbnailEdit').css('display', 'block');
  });

    function validateForm() {
        var categoryId = document.getElementsByName('category_id')[0].value;
        var title = document.getElementsByName('title')[0].value;
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
