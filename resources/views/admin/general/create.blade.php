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
              <h6 class="header-pretitle">Update</h6>
              <!-- Title -->
              <h1 class="header-title">Edit General</h1>
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
              <form class="mb-4" action="{{ route('general.store', $general ? 'update':'create') }}" method="POST" enctype="multipart/form-data"  onsubmit="return validateForm();">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-6">
                        <!-- Company name -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Company Name</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="company_name" name="company_name"  value="{{ $general ? $general->company_name : '' }}">
                        </div>

                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Address -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1"> Address </label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="address" name="address"  value="{{ $general ? $general->address : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Primary phone -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Primary Phone</label>
                            <!-- Input -->
                            <input type="number" class="form-control" id="primary_phone" name="primary_phone"  value="{{ $general ? $general->primary_phone : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Secondary phone -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Secondary Phone</label>
                            <!-- Input -->
                            <input type="number" class="form-control" id="secondary_phone" name="secondary_phone"  value="{{ $general ? $general->secondary_phone : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Delivery fee -->
                        <div class="form-group">
                          <!-- Label -->
                          <label class="form-label">Delivery Fee</label>
                          <!-- Input -->
                          <input type="number" class="form-control mb-3" placeholder="#0.00" name="delivery_fee" value="{{ $general ? $general->delivery_fee : '' }}" data-inputmask="'alias': 'currency', 'numericInput': 'true', 'prefix': '#'">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Story Title -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Story Title</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="story_title" name="story_title"  value="{{ $general ? $general->story_title : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Story description -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1"> Story description </label>
                            <!-- Text -->
                            <small class="form-text text-muted">Customers will read this in the "Story description", so make it good!</small>
                            <!-- Textarea -->
                            <textarea name="story_description" rows="5" class="form-control" >{{ $general ? $general->story_description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Why choose us -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label mb-1"> Why Choose Us </label>
                            <!-- Text -->
                            <small class="form-text text-muted">Customers will read this in the "Why choose us", section so make it good!</small>
                            <!-- Textarea -->
                            <textarea name="why_choose_us" rows="5" class="form-control" >{{ $general ? $general->why_choose_us : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Company email -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Company Email</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="email" name="email"  value="{{ $general ? $general->email : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Facebook link -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Facebook Link</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="facebook" name="facebook"  value="{{ $general ? $general->facebook : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Instagram link -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Instagram Link</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="instagram" name="instagram"  value="{{ $general ? $general->instagram : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <!-- Twitter link -->
                        <div class="form-group">
                            <!-- Label -->
                            <label class="form-label">Twitter Link</label>
                            <!-- Input -->
                            <input type="text" class="form-control" id="twitter" name="twitter"  value="{{ $general ? $general->twitter : '' }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Company logo -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label mb-1" for="thumbnailEdit2">Company Logo</label>
                          <!-- Input -->
                          <input class="form-control" type="file" id="thumbnailEdit2" name="logo" accept="image/*">
                          <!-- Image preview -->
                          <img class="avatar-img rounded" src="{{ (!empty($general ? $general->logo : '')) ? asset('uploads/general_images/'.$general->logo) : asset('uploads/no_image.jpg') }}" alt="{{ $general ? $general->company_name : '' }}" id="showThumbnailEdit2" style="max-width: 15%; display: none;">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Company logo sticky -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label mb-1" for="thumbnailEdit1">Company Logo Sticky</label>
                          <!-- Input -->
                          <input class="form-control" type="file" id="thumbnailEdit1" name="logo_sticky" accept="image/*">
                          <!-- Image preview -->
                          <img class="avatar-img rounded" src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('uploads/no_image.jpg') }}" alt="{{ $general ? $general->company_name : '' }}" id="showThumbnailEdit1" style="max-width: 15%; display: none;">
                      </div>
                    </div>
                    <div class="col-12 col-md-6">
                      <!-- Company logo favicon -->
                      <div class="form-group">
                          <!-- Label -->
                          <label class="form-label mb-1" for="thumbnailEdit3">Company Logo Favicon</label>
                          <!-- Input -->
                          <input class="form-control" type="file" id="thumbnailEdit3" name="logo_favicon" accept="image/*">
                          <!-- Image preview -->
                          <img class="avatar-img rounded" src="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('uploads/no_image.jpg') }}" alt="{{ $general ? $general->company_name : '' }}" id="showThumbnailEdit3" style="max-width: 15%; display: none;">
                      </div>
                    </div>
                </div>

                <!-- Divider -->
                <hr class="mt-5 mb-5">

                <!-- Buttons -->
                <button type="submit" class="btn w-100 btn-primary">
                    Update General
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
        $('#thumbnailEdit1').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailEdit1').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // // Initially display "no_image.jpg"
        $('#showThumbnailEdit1').css('display', 'block');
  });
  $(document).ready(function () {
        $('#thumbnailEdit2').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailEdit2').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // // Initially display "no_image.jpg"
        $('#showThumbnailEdit2').css('display', 'block');
  });
  $(document).ready(function () {
        $('#thumbnailEdit3').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showThumbnailEdit3').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        // // Initially display "no_image.jpg"
        $('#showThumbnailEdit3').css('display', 'block');
  });


    function validateForm() {
        // Get form inputs
        var companyName = document.getElementById('company_name').value;
        var logo = document.getElementById('thumbnailEdit2').value;
        var logoSticky = document.getElementById('thumbnailEdit1').value;
        var address = document.querySelector('textarea[name="address"]').value;
        var primaryPhone = document.getElementById('primary_phone').value;
        var secondaryPhone = document.getElementById('secondary_phone').value;
        var email = document.getElementById('email').value;
        var facebook = document.getElementById('facebook').value;
        var instagram = document.getElementById('instagram').value;
        var twitter = document.getElementById('twitter').value;
        var storyTitle = document.getElementById('story_title').value;
        var storyDescription = document.querySelector('textarea[name="story_description"]').value;
        var whyChooseUs = document.querySelector('textarea[name="why_choose_us"]').value;
        var deliveryFee = document.querySelector('input[name="delivery_fee"]').value;

        // Check if any required field is empty
        if (
            companyName === '' ||
            address === '' ||
            primaryPhone === '' ||
            email === '' ||
            storyTitle === '' ||
            storyDescription === '' ||
            whyChooseUs === '' ||
            deliveryFee === ''
        ) {
            // Show a SweetAlert error message for required fields
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields!',
            });

            // Prevent form submission
            return false;
        }

        // Check if logo or logoSticky fields have file extensions
        if (logo !== '' && !/\.(jpg|jpeg|png|gif)$/i.test(logo)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid file format for Company Logo!',
            });
            return false;
        }

        if (logoSticky !== '' && !/\.(jpg|jpeg|png|gif)$/i.test(logoSticky)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Invalid file format for Company Logo Sticky!',
            });
            return false;
        }

        // If all fields are filled and file formats are valid, allow form submission
        return true;
    }



 </script>

@endsection
