<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="A fully featured Employee theme which can be used to build CRM, CMS, etc." />

    @php
        $general = \App\Models\General::latest('created_at')->first();
    @endphp

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ (!empty($general ? $general->logo_favicon : '')) ? asset('uploads/general_images/'.$general->logo_favicon) : asset('frontend/img/logo.png') }}" type="image/x-icon"/>

    <!-- Map CSS -->
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css" />

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/theme.bundle.css') }}" />

     <!-- Include jQuery library -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <!-- Sweetalert included -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

    <!-- Title -->
    <title>RAS Employee Dashboard</title>
  </head>
  <body>
    <!-- Scroll Bar Style -->
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <style>
        ::-webkit-scrollbar {
           width: 10px;
        }
        ::-webkit-scrollbar-thumb {
          border-radius: 30px;
          background: -webkit-gradient(linear,left top,left bottom,from(#e6e6e6),to(#cacaca));
          }
        ::-webkit-scrollbar-track {
          background-color: #fff;
          border-radius:10px;
        }
    </style>

    <!-- MODALS -->
    <!-- Modal: Members -->
    <div class="modal fade" id="modalMembers" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-card card" data-list='{"valueNames": ["name"]}'>
            <div class="card-header">

              <!-- Title -->
              <h4 class="card-header-title" id="exampleModalCenterTitle">
                Add a member
              </h4>

              <!-- Close -->
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="card-header">

              <!-- Form -->
              <form>
                <div class="input-group input-group-flush input-group-merge input-group-reverse">
                  <input class="form-control list-search" type="search" placeholder="Search">
                  <div class="input-group-text">
                    <span class="fe fe-search"></span>
                  </div>
                </div>
              </form>

            </div>
            <div class="card-body">

              <!-- List group -->
              <ul class="list-group list-group-flush list my-n3">
                <li class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a href="./profile-posts.html" class="avatar">
                        <img src="./assets/img/avatars/profiles/avatar-5.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Title -->
                      <h4 class="mb-1 name">
                        <a href="./profile-posts.html">Miyah Myles</a>
                      </h4>

                      <!-- Time -->
                      <p class="small mb-0">
                        <span class="text-success">●</span> Online
                      </p>

                    </div>
                    <div class="col-auto">

                      <!-- Button -->
                      <a href="#!" class="btn btn-sm btn-white">
                        Add
                      </a>

                    </div>
                  </div> <!-- / .row -->
                </li>
                <li class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a href="./profile-posts.html" class="avatar">
                        <img src="./assets/img/avatars/profiles/avatar-6.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Title -->
                      <h4 class="mb-1 name">
                        <a href="./profile-posts.html">Ryu Duke</a>
                      </h4>

                      <!-- Time -->
                      <p class="small mb-0">
                        <span class="text-success">●</span> Online
                      </p>

                    </div>
                    <div class="col-auto">

                      <!-- Button -->
                      <a href="#!" class="btn btn-sm btn-white">
                        Add
                      </a>

                    </div>
                  </div> <!-- / .row -->
                </li>
                <li class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a href="./profile-posts.html" class="avatar">
                        <img src="./assets/img/avatars/profiles/avatar-7.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Title -->
                      <h4 class="mb-1 name">
                        <a href="./profile-posts.html">Glen Rouse</a>
                      </h4>

                      <!-- Time -->
                      <p class="small mb-0">
                        <span class="text-warning">●</span> Busy
                      </p>

                    </div>
                    <div class="col-auto">

                      <!-- Button -->
                      <a href="#!" class="btn btn-sm btn-white">
                        Add
                      </a>

                    </div>
                  </div> <!-- / .row -->
                </li>
                <li class="list-group-item">
                  <div class="row align-items-center">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a href="./profile-posts.html" class="avatar">
                        <img src="./assets/img/avatars/profiles/avatar-8.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Title -->
                      <h4 class="mb-1 name">
                        <a href="./profile-posts.html">Grace Gross</a>
                      </h4>

                      <!-- Time -->
                      <p class="small mb-0">
                        <span class="text-danger">●</span> Offline
                      </p>

                    </div>
                    <div class="col-auto">

                      <!-- Button -->
                      <a href="#!" class="btn btn-sm btn-white">
                        Add
                      </a>

                    </div>
                  </div> <!-- / .row -->
                </li>
              </ul>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Kanban task -->
    <div class="modal fade" id="modalKanbanTask" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-lighter">
          <div class="modal-body">

            <!-- Header -->
            <div class="row">
              <div class="col">

                <!-- Prettitle -->
                <h6 class="text-uppercase text-muted mb-3">
                  <a href="#!" class="text-reset">How to Use Kanban</a>
                </h6>

                <!-- Title -->
                <h2 class="mb-2">
                  Update Dashkit to include new components!
                </h2>

                <!-- Subtitle -->
                <p class="text-muted mb-0">
                  This is a description of this task. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum magna nisi, ultrices ut pharetra eget.
                </p>

              </div>
              <div class="col-auto">

                <!-- Close -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>
            </div> <!-- / .row -->

            <!-- Divider -->
            <hr class="my-4">

            <!-- Buttons -->
            <div class="mb-4">
              <div class="row">
                <div class="col">

                  <!-- Reaction -->
                  <a href="#!" class="btn btn-sm btn-white">
                    😬 1
                  </a>
                  <a href="#!" class="btn btn-sm btn-white">
                    👍 2
                  </a>
                  <a href="#!" class="btn btn-sm btn-white">
                    Add Reaction
                  </a>

                </div>
                <div class="col-auto me-n3">

                  <!-- Avatar group -->
                  <div class="avatar-group d-none d-sm-flex">
                    <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Ab Hadley">
                      <img src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                    </a>
                    <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Adolfo Hess">
                      <img src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                    </a>
                    <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Daniela Dewitt">
                      <img src="./assets/img/avatars/profiles/avatar-4.jpg" alt="..." class="avatar-img rounded-circle">
                    </a>
                    <a href="./profile-posts.html" class="avatar avatar-xs" data-bs-toggle="tooltip" title="Miyah Myles">
                      <img src="./assets/img/avatars/profiles/avatar-5.jpg" alt="..." class="avatar-img rounded-circle">
                    </a>
                  </div>

                </div>
                <div class="col-auto">

                  <!-- Button -->
                  <a href="#!" class="btn btn-sm btn-white">
                    Share
                  </a>

                </div>
              </div> <!-- / .row -->
            </div>

            <!-- Card -->
            <div class="card">
              <div class="card-header">

                <!-- Title -->
                <h4 class="card-header-title">
                  Files
                </h4>

                <!-- Button -->
                <a href="#!" class="btn btn-sm btn-white">
                  Add files
                </a>

              </div>
              <div class="card-body">
                <div class="list-group list-group-flush my-n3">
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <a href="./project-overview.html" class="avatar">
                          <img src="./assets/img/files/file-1.jpg" alt="..." class="avatar-img rounded">
                        </a>

                      </div>
                      <div class="col ms-n2">

                        <!-- Title -->
                        <h4 class="mb-1">
                          <a href="./project-overview.html">Launchday logo</a>
                        </h4>

                        <!-- Time -->
                        <p class="card-text small text-muted">
                          1.5mb PNG Dave
                        </p>

                      </div>
                      <div class="col-auto">

                        <!-- Dropdown -->
                        <div class="dropdown">
                          <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a href="#!" class="dropdown-item">
                              Action
                            </a>
                            <a href="#!" class="dropdown-item">
                              Another action
                            </a>
                            <a href="#!" class="dropdown-item">
                              Something else here
                            </a>
                          </div>
                        </div>

                      </div>
                    </div> <!-- / .row -->
                  </div>
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <a href="./project-overview.html" class="avatar">
                          <img src="./assets/img/files/file-1.jpg" alt="..." class="avatar-img rounded">
                        </a>

                      </div>
                      <div class="col ms-n2">

                        <!-- Title -->
                        <h4 class="mb-1">
                          <a href="./project-overview.html">Launchday logo</a>
                        </h4>

                        <!-- Time -->
                        <p class="card-text small text-muted">
                          1.5mb PNG Dave
                        </p>

                      </div>
                      <div class="col-auto">

                        <!-- Dropdown -->
                        <div class="dropdown">
                          <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end">
                            <a href="#!" class="dropdown-item">
                              Action
                            </a>
                            <a href="#!" class="dropdown-item">
                              Another action
                            </a>
                            <a href="#!" class="dropdown-item">
                              Something else here
                            </a>
                          </div>
                        </div>

                      </div>
                    </div> <!-- / .row -->
                  </div>
                </div>

              </div>
            </div>

            <!-- Card -->
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="...">
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Form -->
                    <form class="mt-1">
                      <textarea class="form-control form-control-flush form-control" data-autosize rows="1" placeholder="Leave a comment"></textarea>
                    </form>

                  </div>
                  <div class="col-auto align-self-end">

                    <!-- Icons -->
                    <div class="text-muted mb-2">
                      <a href="#!" class="text-reset me-3">
                        <i class="fe fe-camera"></i>
                      </a>
                      <a href="#!" class="text-reset me-3">
                        <i class="fe fe-paperclip"></i>
                      </a>
                      <a href="#!" class="text-reset">
                        <i class="fe fe-mic"></i>
                      </a>
                    </div>

                  </div>
                </div>
              </div>
              <div class="card-body">

                <!-- Comments -->
                <div class="comment mb-3">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a class="avatar avatar-sm" href="./profile-posts.html">
                        <img src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Body -->
                      <div class="comment-body">

                        <div class="row">
                          <div class="col">

                            <!-- Title -->
                            <h5 class="comment-title">
                              Ab Hadley
                            </h5>

                          </div>
                          <div class="col-auto">

                            <!-- Time -->
                            <time class="comment-time">
                              11:12
                            </time>

                          </div>
                        </div> <!-- / .row -->

                        <!-- Text -->
                        <p class="comment-text">
                          Looking good Dianna! I like the image grid on the left, but it feels like a lot to process and doesn't really <em>show</em> me what the product does? I think using a short looping video or something similar demo'ing the product might be better?
                        </p>

                      </div>

                    </div>
                  </div> <!-- / .row -->
                </div>
                <div class="comment">
                  <div class="row">
                    <div class="col-auto">

                      <!-- Avatar -->
                      <a class="avatar avatar-sm" href="./profile-posts.html">
                        <img src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." class="avatar-img rounded-circle">
                      </a>

                    </div>
                    <div class="col ms-n2">

                      <!-- Body -->
                      <div class="comment-body">

                        <div class="row">
                          <div class="col">

                            <!-- Title -->
                            <h5 class="comment-title">
                              Adolfo Hess
                            </h5>

                          </div>
                          <div class="col-auto">

                            <!-- Time -->
                            <time class="comment-time">
                              11:12
                            </time>

                          </div>
                        </div> <!-- / .row -->

                        <!-- Text -->
                        <p class="comment-text">
                          Any chance you're going to link the grid up to a public gallery of sites built with Launchday?
                        </p>

                      </div>

                    </div>
                  </div> <!-- / .row -->
                </div>

              </div>
            </div>

            <!-- Card -->
            <div class="card mb-0">
              <div class="card-header">

                <!-- Title -->
                <h4 class="card-header-title">
                  Activity
                </h4>

              </div>
              <div class="card-body">
                <div class="list-group list-group-flush list-group-activity my-n3">
                  <div class="list-group-item">
                    <div class="row">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-sm">
                          <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="...">
                        </div>

                      </div>
                      <div class="col ms-n2">

                        <!-- Heading -->
                        <h5 class="mb-1">
                          Johnathan Goldstein
                        </h5>

                        <!-- Text -->
                        <p class="small text-gray-700 mb-0">
                          Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                        </p>

                        <!-- Time -->
                        <small class="text-muted">
                          2m ago
                        </small>

                      </div>
                    </div> <!-- / .row -->
                  </div>
                  <div class="list-group-item">
                    <div class="row">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-sm">
                          <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="...">
                        </div>

                      </div>
                      <div class="col ms-n2">

                        <!-- Heading -->
                        <h5 class="mb-1">
                          Johnathan Goldstein
                        </h5>

                        <!-- Text -->
                        <p class="small text-gray-700 mb-0">
                          Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                        </p>

                        <!-- Time -->
                        <small class="text-muted">
                          2m ago
                        </small>

                      </div>
                    </div> <!-- / .row -->
                  </div>
                  <div class="list-group-item">
                    <div class="row">
                      <div class="col-auto">

                        <!-- Avatar -->
                        <div class="avatar avatar-sm">
                          <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="...">
                        </div>

                      </div>
                      <div class="col ms-n2">

                        <!-- Heading -->
                        <h5 class="mb-1">
                          Johnathan Goldstein
                        </h5>

                        <!-- Text -->
                        <p class="small text-gray-700 mb-0">
                          Uploaded the files “Launchday Logo” and “Revisiting the Past”.
                        </p>

                        <!-- Time -->
                        <small class="text-muted">
                          2m ago
                        </small>

                      </div>
                    </div> <!-- / .row -->
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- Modal: Kanban task empty -->
    <div class="modal fade" id="modalKanbanTaskEmpty" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-lighter">
          <div class="modal-body">

            <!-- Header -->
            <div class="row">
              <div class="col">

                <!-- Prettitle -->
                <h6 class="text-uppercase text-muted mb-3">
                  <a href="#!" class="text-reset">How to Use Kanban</a>
                </h6>

                <!-- Title -->
                <h2 class="mb-2">
                  Update Dashkit to include new components!
                </h2>

                <!-- Subtitle -->
                <textarea class="form-control form-control-flush form-control-auto" data-autosize rows="1" placeholder="Add a description..."></textarea>

              </div>
              <div class="col-auto">

                <!-- Close -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

              </div>
            </div> <!-- / .row -->

            <!-- Divider -->
            <hr class="my-4">

            <!-- Buttons -->
            <div class="mb-4">
              <div class="row">
                <div class="col">

                  <!-- Button -->
                  <a href="#!" class="btn btn-sm btn-white">
                    Add Reaction
                  </a>

                </div>
                <div class="col-auto">

                  <!-- Button -->
                  <a href="#!" class="btn btn-sm btn-white">
                    Share
                  </a>

                </div>
              </div> <!-- / .row -->
            </div>

            <!-- Card -->
            <div class="card">
              <div class="card-body">
                <div class="dropzone dropzone-multiple" data-dropzone='{"url": "https://"}'>

                  <!-- Fallback -->
                  <div class="fallback">
                    <div class="form-group">
                      <label class="form-label" for="customFileUpload">Choose file</label>
                      <input class="form-control" type="file" id="customFileUpload" multiple>
                    </div>
                  </div>

                  <!-- Preview -->
                  <ul class="dz-preview dz-preview-multiple list-group list-group-lg list-group-flush">
                    <li class="list-group-item">
                      <div class="row align-items-center">
                        <div class="col-auto">

                          <!-- Image -->
                          <div class="avatar">
                            <img class="avatar-img rounded" src="data:image/svg+xml,%3csvg3c/svg%3e" alt="..." data-dz-thumbnail>
                          </div>

                        </div>
                        <div class="col ms-n3">

                          <!-- Heading -->
                          <h4 class="mb-1" data-dz-name>...</h4>

                          <!-- Text -->
                          <small class="text-muted" data-dz-size></small>

                        </div>
                        <div class="col-auto">

                          <!-- Dropdown -->
                          <div class="dropdown">
                            <a href="#" class="dropdown-ellipses dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a href="#" class="dropdown-item" data-dz-remove>
                                Remove
                              </a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </li>
                  </ul>

                </div>
              </div>
            </div>

            <!-- Card -->
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="...">
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Form -->
                    <form class="mt-1">
                      <textarea class="form-control form-control-flush" data-autosize rows="1" placeholder="Leave a comment"></textarea>
                    </form>

                  </div>
                  <div class="col-auto align-self-end">

                    <!-- Icons -->
                    <div class="text-muted mb-2">
                      <a href="#!" class="text-reset me-3">
                        <i class="fe fe-camera"></i>
                      </a>
                      <a href="#!" class="text-reset me-3">
                        <i class="fe fe-paperclip"></i>
                      </a>
                      <a href="#!" class="text-reset">
                        <i class="fe fe-mic"></i>
                      </a>
                    </div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- OFFCANVAS -->

    <!-- Offcanvas: Search -->
    <div class="offcanvas offcanvas-start" id="sidebarOffcanvasSearch" tabindex="-1">
      <div class="offcanvas-body" data-list='{"valueNames": ["name"]}'>

        <!-- Form -->
        <form class="mb-4">
          <div class="input-group input-group-merge input-group-rounded input-group-reverse">
            <input class="form-control list-search" type="search" placeholder="Search">
            <div class="input-group-text">
              <span class="fe fe-search"></span>
            </div>
          </div>
        </form>

        <!-- List group -->
        <div class="my-n3">
          <div class="list-group list-group-flush list-group-focus list">
            <a class="list-group-item" href="./team-overview.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar">
                    <img src="./assets/img/avatars/teams/team-logo-1.jpg" alt="..." class="avatar-img rounded">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Airbnb
                  </h4>

                  <!-- Time -->
                  <p class="small text-muted mb-0">
                    <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./team-overview.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar">
                    <img src="./assets/img/avatars/teams/team-logo-2.jpg" alt="..." class="avatar-img rounded">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Medium Corporation
                  </h4>

                  <!-- Time -->
                  <p class="small text-muted mb-0">
                    <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 2hr ago</time>
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./project-overview.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-4by3">
                    <img src="./assets/img/avatars/projects/project-1.jpg" alt="..." class="avatar-img rounded">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Homepage Redesign
                  </h4>

                  <!-- Time -->
                  <p class="small text-muted mb-0">
                    <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./project-overview.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-4by3">
                    <img src="./assets/img/avatars/projects/project-2.jpg" alt="..." class="avatar-img rounded">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Travels & Time
                  </h4>

                  <!-- Time -->
                  <p class="small text-muted mb-0">
                    <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./project-overview.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar avatar-4by3">
                    <img src="./assets/img/avatars/projects/project-3.jpg" alt="..." class="avatar-img rounded">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Safari Exploration
                  </h4>

                  <!-- Time -->
                  <p class="small text-muted mb-0">
                    <span class="fe fe-clock"></span> <time datetime="2018-05-24">Updated 4hr ago</time>
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./profile-posts.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar">
                    <img src="./assets/img/avatars/profiles/avatar-1.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Dianna Smiley
                  </h4>

                  <!-- Status -->
                  <p class="text-body small mb-0">
                    <span class="text-success">●</span> Online
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
            <a class="list-group-item" href="./profile-posts.html">
              <div class="row align-items-center">
                <div class="col-auto">

                  <!-- Avatar -->
                  <div class="avatar">
                    <img src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." class="avatar-img rounded-circle">
                  </div>

                </div>
                <div class="col ms-n2">

                  <!-- Title -->
                  <h4 class="text-body text-focus mb-1 name">
                    Ab Hadley
                  </h4>

                  <!-- Status -->
                  <p class="text-body small mb-0">
                    <span class="text-danger">●</span> Offline
                  </p>

                </div>
              </div> <!-- / .row -->
            </a>
          </div>
        </div>

      </div>
    </div>

    <!-- Offcanvas: Activity -->
    <div class="offcanvas offcanvas-start" id="sidebarOffcanvasActivity" tabindex="-1">
      <div class="offcanvas-header">

        <!-- Title -->
        <h4 class="offcanvas-title">
          Notifications
        </h4>

        <!-- Navs -->
        <ul class="nav nav-tabs nav-tabs-sm modal-header-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#modalActivityAction">Action</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#modalActivityUser">User</a>
          </li>
        </ul>

      </div>
      <div class="offcanvas-body">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="modalActivityAction">

            <!-- List group -->
            <div class="list-group list-group-flush list-group-activity my-n3">
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-mail"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Launchday 1.4.0 update email sent
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Sent to all 1,851 subscribers over a 24 hour period
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-archive"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      New project "Goodkit" created
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Looks like there might be a new theme soon.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-code"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dashkit 1.5.0 was deployed.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      A successful to deploy to production was executed.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-git-branch"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      "Update Dependencies" branch was created.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      This branch was created off of the "master" branch.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-mail"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Launchday 1.4.0 update email sent
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Sent to all 1,851 subscribers over a 24 hour period
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-archive"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      New project "Goodkit" created
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Looks like there might be a new theme soon.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-code"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dashkit 1.5.0 was deployed.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      A successful to deploy to production was executed.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-git-branch"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      "Update Dependencies" branch was created.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      This branch was created off of the "master" branch.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-mail"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Launchday 1.4.0 update email sent
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Sent to all 1,851 subscribers over a 24 hour period
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-archive"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      New project "Goodkit" created
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Looks like there might be a new theme soon.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-code"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dashkit 1.5.0 was deployed.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      A successful to deploy to production was executed.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm">
                      <div class="avatar-title fs-lg bg-primary-soft rounded-circle text-primary">
                        <i class="fe fe-git-branch"></i>
                      </div>
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      "Update Dependencies" branch was created.
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      This branch was created off of the "master" branch.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
            </div>

          </div>
          <div class="tab-pane fade" id="modalActivityUser">

            <!-- List group -->
            <div class="list-group list-group-flush list-group-activity my-n3">
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dianna Smiley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Uploaded the files "Launchday Logo" and "New Design".
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Ab Hadley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Shared the "Why Dashkit?" post with 124 subscribers.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      1h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-offline">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Adolfo Hess
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Exported sales data from Launchday's subscriber data.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      3h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dianna Smiley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Uploaded the files "Launchday Logo" and "New Design".
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Ab Hadley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Shared the "Why Dashkit?" post with 124 subscribers.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      1h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-offline">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Adolfo Hess
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Exported sales data from Launchday's subscriber data.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      3h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dianna Smiley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Uploaded the files "Launchday Logo" and "New Design".
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Ab Hadley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Shared the "Why Dashkit?" post with 124 subscribers.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      1h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-offline">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Adolfo Hess
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Exported sales data from Launchday's subscriber data.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      3h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-1.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Dianna Smiley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Uploaded the files "Launchday Logo" and "New Design".
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      2m ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-online">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-2.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Ab Hadley
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Shared the "Why Dashkit?" post with 124 subscribers.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      1h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
              <a class="list-group-item text-reset" href="#!">
                <div class="row">
                  <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar avatar-sm avatar-offline">
                      <img class="avatar-img rounded-circle" src="./assets/img/avatars/profiles/avatar-3.jpg" alt="..." />
                    </div>

                  </div>
                  <div class="col ms-n2">

                    <!-- Heading -->
                    <h5 class="mb-1">
                      Adolfo Hess
                    </h5>

                    <!-- Text -->
                    <p class="small text-gray-700 mb-0">
                      Exported sales data from Launchday's subscriber data.
                    </p>

                    <!-- Time -->
                    <small class="text-muted">
                      3h ago
                    </small>

                  </div>
                </div> <!-- / .row -->
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- NAVIGATION -->
    @include('employee.body.navbar')

    <!-- Sweetalert included -->
    @include('sweetalert::alert')

    <!-- MAIN CONTENT -->
    <div class="main-content">

      <!-- CARDS -->
        @yield('employee')

    </div><!-- / .main-content -->

    <!-- JAVASCRIPT -->
    <!-- Map JS -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>

    <!-- Vendor JS -->
    <script src="{{ asset('backend/assets/js/vendor.bundle.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('backend/assets/js/theme.bundle.js') }}"></script>

     <!-- Sweetalert included -->
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  </body>
</html>
