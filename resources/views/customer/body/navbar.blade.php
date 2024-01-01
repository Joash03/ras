<!-- NAVIGATION -->
<nav class="navbar navbar-vertical fixed-start navbar-expand-md navbar-light" id="sidebar">
  <div class="container-fluid">

    @php
     $id = Auth::user()->id;
     $profileData = App\Models\User::find($id);
    @endphp

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="./index.html">
      <img src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo_2.png') }}" class="navbar-brand-img mx-auto" alt="...">
    </a>

    <!-- User (xs) -->
    <div class="navbar-user d-md-none">

      <!-- Dropdown -->
      <div class="dropdown">

        <!-- Toggle -->
        <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-sm avatar-online">
              <img src="{{ (!empty($profileData->photo)) ? url('uploads/customer_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" class="avatar-img rounded-circle" alt="...">
          </div>
        </a>

        <!-- Menu -->
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarIcon">
          <a href="{{ route('customer.profile') }}" class="dropdown-item">Profile</a>
          <a href="{{ route('customer.change.password') }}" class="dropdown-item"> Change Password</a>
          <hr class="dropdown-divider">
          <a href="{{ route('customer.logout') }}" class="dropdown-item">Sign out</a>
        </div>

      </div>

    </div>

    <!-- Collapse -->
    <div class="collapse navbar-collapse" id="sidebarCollapse">

      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge input-group-reverse">
          <input class="form-control" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-text">
            <span class="fe fe-search"></span>
          </div>
        </div>
      </form>

      <!-- Divider -->
      <hr class="navbar-user my-xl-3 py-xl-0 my-lg-3 py-lg-0 my-md-3 py-md-0">

      <!-- Heading -->
      <h6 class="navbar-heading">
          SWitch Navigation
      </h6>

      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}" href="{{ route('customer.dashboard') }}">
                <i class="fe fe-home"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                <i class="fe fe-home"></i> Website Home
            </a>
        </li>
      </ul>

      <!-- Divider -->
      <hr class="navbar-divider my-3">

      <!-- Heading -->
      <h6 class="navbar-heading">
        Order
      </h6>

      <!-- Navigation -->
      <ul class="navbar-nav mb-md-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['customer.order.index', 'customer.order.history']) ? 'active' : '' }}" href="#sidebarOrder" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['customer.order.index', 'customer.order.history']) ? 'true' : 'false' }}" aria-controls="sidebarOrder">
                <i class="fe fe-clipboard"></i>Order
            </a>
            <div class="collapse {{ request()->routeIs(['customer.order.index', 'customer.order.history']) ? 'show' : '' }}" id="sidebarOrder">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.order.index') ? 'active' : '' }}" href="{{ route('customer.order.index') }}">
                            Order List <span class="badge bg-primary-soft ms-auto">New</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('customer.order.history') }}" href="{{ route('customer.order.history') }}">
                            Order History
                        </a>
                    </li>
                </ul>
            </div>
        </li>
      </ul>

      <!-- Push content down -->
      <div class="mt-auto"></div>


        <!-- User (md) -->
        <div class="navbar-user d-none d-md-flex" id="sidebarUser">

          <!-- Icon -->
          <a class="navbar-user-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasActivity" aria-controls="sidebarOffcanvasActivity">
            <span class="icon">
              <i class="fe fe-bell"></i>
            </span>
          </a>

          <!-- Dropup -->
          <div class="dropup">

            <!-- Toggle -->
            <a href="#" id="sidebarIconCopy" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="avatar avatar-sm avatar-online">
                  <img src="{{ (!empty($profileData->photo)) ? url('uploads/customer_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" class="avatar-img rounded-circle" alt="...">
              </div>
            </a>

            <!-- Menu -->
            <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
              <a href="{{ route('customer.profile') }}" class="dropdown-item">Profile</a>
              <a href="{{ route('customer.change.password') }}" class="dropdown-item">Change Password</a>
              <hr class="dropdown-divider">
              <a href="{{ route('customer.logout') }}" class="dropdown-item">Sign out</a>
            </div>

          </div>

          <!-- Icon -->
          <a class="navbar-user-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasSearch" aria-controls="sidebarOffcanvasSearch">
            <span class="icon">
              <i class="fe fe-search"></i>
            </span>
          </a>

        </div>

    </div> <!-- / .navbar-collapse -->

  </div>
</nav>
