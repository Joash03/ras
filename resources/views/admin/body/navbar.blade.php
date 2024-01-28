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
    <a class="navbar-brand" href="{{ route('home') }}">
      <img src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo_2.png') }}" class="navbar-brand-img mx-auto" alt="...">
    </a>

    <!-- User (xs) -->
    <div class="navbar-user d-md-none">

      <!-- Dropdown -->
      <div class="dropdown">

        <!-- Toggle -->
        <a href="#" id="sidebarIcon" class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-sm avatar-online">
              <img src="{{ (!empty($profileData->photo)) ? url('uploads/admin_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" class="avatar-img rounded-circle" alt="...">
          </div>
        </a>

        <!-- Menu -->
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarIcon">
          <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
          <a href="{{ route('admin.change.password') }}" class="dropdown-item"> Change Password</a>
          <hr class="dropdown-divider">
          <a href="{{ route('admin.logout') }}" class="dropdown-item">Sign out</a>
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

        @php
            $excludedUserId = 1;
        @endphp

        @if (auth()->user()->id != $excludedUserId)
            <!-- Navbar with permission -->
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fe fe-layers"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fe fe-grid"></i> Website Home
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasActivity" aria-contrtols="sidebarOffcanvasActivity">
                        <span class="fe fe-bell"></span> Notifications
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Sales Features
            </h6>

            <ul class="navbar-nav">
                @if(Auth::user()->can('pos.index'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pos.index') ? 'active' : '' }}" href="{{ route('pos.index') }}">
                        <i class="fe fe-shopping-cart"></i> POS
                    </a>
                </li>
                @endif

                @if(Auth::user()->can('order.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['order.index', 'order.history']) ? 'active' : '' }}" href="#sidebarOrder" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['order.index', 'order.history']) ? 'true' : 'false' }}" aria-controls="sidebarOrder">
                        <i class="fe fe-clipboard"></i>Order
                    </a>
                    <div class="collapse {{ request()->routeIs(['order.index', 'order.history']) ? 'show' : '' }}" id="sidebarOrder">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('order.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('order.index') ? 'active' : '' }}" href="{{ route('order.index') }}">
                                    Order List <span class="badge bg-primary-soft ms-auto">New</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('order.history'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('order.history') ? 'active' : '' }}" href="{{ route('order.history') }}">
                                    Order History
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('reserve.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'active' : '' }}" href="#sidebarReserve" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'true' : 'false' }}" aria-controls="sidebarReserve">
                        <i class="fe fe-home"></i>Reservations
                    </a>
                    <div class="collapse {{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'show' : '' }}" id="sidebarReserve">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('reserve.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reserve.index') ? 'active' : '' }}" href="{{ route('reserve.index') }}">
                                    Reservations List <span class="badge bg-primary-soft ms-auto">New</span>
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('reserve.history'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reserve.history') ? 'active' : '' }}" href="{{ route('reserve.history') }}">
                                    Reservations History
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('category.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'active' : '' }}" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'true' : 'false' }}" aria-controls="sidebarCategory">
                        <i class="fe fe-clipboard"></i>Category
                    </a>
                    <div class="collapse {{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'show' : '' }}" id="sidebarCategory">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('category.index.menu'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'menu']) }}">
                                    Menu Category
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('category.index.product'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'product']) }}">
                                    Product Category
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('category.index.store'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'store']) }}">
                                    Store Category
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('category.index.blog'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'blog']) }}">
                                    Blog Category
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('category.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.create') ? 'active' : '' }}" href="{{ route('category.create') }}">
                                    Create Category
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('category.import'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.import') ? 'active' : '' }}" href="{{ route('category.import') }}">
                                    Import Category
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('menu.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'active' : '' }}" href="#sidebarMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'true' : 'false' }}" aria-controls="sidebarMenu">
                        <i class="fe fe-clipboard"></i>Menu
                    </a>
                    <div class="collapse {{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'show' : '' }}" id="sidebarMenu">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('menu.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.index') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                                Menu List
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('menu.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.create') ? 'active' : '' }}" href="{{ route('menu.create') }}">
                                Create Menu
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('menu.import'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.import') ? 'active' : '' }}" href="{{ route('menu.import') }}">
                                    Import Menu
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('product.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'active' : '' }}" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'true' : 'false' }}" aria-controls="sidebarProduct">
                        <i class="fe fe-clipboard"></i>Product
                    </a>
                    <div class="collapse {{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'show' : '' }}" id="sidebarProduct">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('product.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">
                                Product List
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('product.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}" href="{{ route('product.create') }}">
                                Create Product
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('product.import'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.import') ? 'active' : '' }}" href="{{ route('product.import') }}">
                                    Import Product
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Inventory Features
            </h6>

            <ul class="navbar-nav">
                @if(Auth::user()->can('inventory.product.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'active' : '' }}" href="#sidebarProductInventory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'true' : 'false' }}" aria-controls="sidebarProductInventory">
                        <i class="fe fe-clipboard"></i>Product Inventory
                    </a>
                    <div class="collapse {{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'show' : '' }}" id="sidebarProductInventory">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('inventory.product.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.index') ? 'active' : '' }}" href="{{ route('inventory.product.index') }}">
                                    Product List
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('inventory.product.outofstock'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.outofstock') ? 'active' : '' }}" href="{{ route('inventory.product.outofstock') }}">
                                    Products Out of Stock
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('inventory.product.expiredproduct'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.expiredproduct') ? 'active' : '' }}" href="{{ route('inventory.product.expiredproduct') }}">
                                    Exipired Products
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('inventory.product.edit'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.edit') ? 'active' : '' }}" href="{{ route('inventory.product.edit') }}">
                                    New Inventory
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('inventory.store.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'active' : '' }}" href="#sidebarStoreInventory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'true' : 'false' }}" aria-controls="sidebarStoreInventory">
                        <i class="fe fe-dollar-sign"></i> Store Inventory
                    </a>
                    <div class="collapse {{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'show' : '' }}" id="sidebarStoreInventory">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('inventory.store.index'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.store.index') }}" class="nav-link {{ request()->routeIs('inventory.store.index') ? 'active' : '' }}">
                                    Store List
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('inventory.store.add'))
                            <li class="nav-item">
                                <a href="{{ route('inventory.store.add') }}" class="nav-link {{ request()->routeIs('inventory.store.add') ? 'active' : '' }}">
                                    Create Store Inventory
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Financial Features
            </h6>

            <ul class="navbar-nav">
                @if(Auth::user()->can('expense.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'active' : '' }}" href="#sidebarExpenses" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'true' : 'false' }}" aria-controls="sidebarExpenses">
                        <i class="fe fe-clipboard"></i>Expenses
                    </a>
                    <div class="collapse {{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'show' : '' }}" id="sidebarExpenses">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('expense.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.create') ? 'active' : '' }}" href="{{ route('expense.create') }}">
                                Create Expense
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('expense.daily'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.daily') ? 'active' : '' }}" href="{{ route('expense.daily') }}">
                                Daily Expenses
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('expense.weekly'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.weekly') ? 'active' : '' }}" href="{{ route('expense.weekly') }}">
                                Weekly Expenses
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('expense.monthly'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.monthly') ? 'active' : '' }}" href="{{ route('expense.monthly') }}">
                                Monthly Expenses
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('expense.yearly'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.yearly') ? 'active' : '' }}" href="{{ route('expense.yearly') }}">
                                Yearly Expenses
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('salary.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'active' : '' }}" href="#sidebarSalaries" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'true' : 'false' }}" aria-controls="sidebarSalaries">
                        <i class="fe fe-dollar-sign"></i> Salaries
                    </a>
                    <div class="collapse {{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'show' : '' }}" id="sidebarSalaries">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('salary.advance.all'))
                            <li class="nav-item">
                                <a href="{{ route('salary.advance.all') }}" class="nav-link {{ request()->routeIs('salary.advance.all') ? 'active' : '' }}">
                                    All Advance Salaries
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.advance.add'))
                            <li class="nav-item">
                                <a href="{{ route('salary.advance.add') }}" class="nav-link {{ request()->routeIs('salary.advance.add') ? 'active' : '' }}">
                                    Create Advance Salary
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.pay'))
                            <li class="nav-item">
                                <a href="{{ route('salary.pay') }}" class="nav-link {{ request()->routeIs('salary.pay') ? 'active' : '' }}">
                                    Pay Salary
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('salary.paid'))
                            <li class="nav-item">
                                <a href="{{ route('salary.paid') }}" class="nav-link {{ request()->routeIs('salary.paid') ? 'active' : '' }}">
                                    Last Month Salary
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Management Features
            </h6>

            <ul class="navbar-nav">
                @if(Auth::user()->can('employee.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'active' : '' }}" href="#sidebarEmployees" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'true' : 'false' }}" aria-controls="sidebarEmployees">
                        <i class="fe fe-users"></i> Employees
                    </a>
                    <div class="collapse {{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'show' : '' }}" id="sidebarEmployees">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('employee.all.current'))
                            <li class="nav-item">
                                <a href="{{ route('employee.all', ['status' => 'active']) }}" class="nav-link {{ request()->routeIs('employee.all') ? 'active' : '' }}">
                                    Current Employees
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('employee.all.former'))
                            <li class="nav-item">
                                <a href="{{ route('employee.all', ['status' => 'inactive']) }}" class="nav-link {{ request()->routeIs('employee.all') ? 'active' : '' }}">
                                    Former Employees
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('employee.add'))
                            <li class="nav-item">
                                <a href="{{ route('employee.add') }}" class="nav-link {{ request()->routeIs('employee.add') ? 'active' : '' }}">
                                    Create Employee
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('employee.role.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['employee.role.all', 'employee.role.add', 'employee.role.edit']) ? 'active' : '' }}" href="#sidebarEmployeeRoles" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['employee.role.all', 'employee.role.add', 'employee.role.edit']) ? 'true' : 'false' }}" aria-controls="sidebarEmployeeRoles">
                        <i class="fe fe-users"></i> Employee Roles
                    </a>
                    <div class="collapse {{ request()->routeIs(['employee.role.all', 'employee.role.add', 'employee.role.edit']) ? 'show' : '' }}" id="sidebarEmployeeRoles">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('employee.role.all'))
                            <li class="nav-item">
                                <a href="{{ route('employee.role.all') }}" class="nav-link {{ request()->routeIs('employee.role.all') ? 'active' : '' }}">
                                    All Employee Roles
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('employee.role.add'))
                            <li class="nav-item">
                                <a href="{{ route('employee.role.add') }}" class="nav-link {{ request()->routeIs('employee.role.add') ? 'active' : '' }}">
                                    Assign Employee Roles
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('attendance.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'active' : '' }}" href="#sidebarAttendance" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'true' : 'false' }}" aria-controls="sidebarAttendance">
                        <i class="fe fe-check-square"></i>Attendance
                    </a>
                    <div class="collapse {{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'show' : '' }}" id="sidebarAttendance">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('employee.attendance'))
                            <li class="nav-item">
                                <a href="{{ route('employee.attendance') }}" class="nav-link {{ request()->routeIs('employee.attendance') ? 'active' : '' }}">
                                    Attendance List
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('attendance.take'))
                            <li class="nav-item">
                                <a href="{{ route('attendance.take') }}" class="nav-link {{ request()->routeIs('attendance.take') ? 'active' : '' }}">
                                    Take Attendance
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('customer.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'active' : '' }}" href="#sidebarCustomers" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'true' : 'false' }}" aria-controls="sidebarCustomers">
                        <i class="fe fe-users"></i> Customers
                    </a>
                    <div class="collapse {{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'show' : '' }}" id="sidebarCustomers">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('customer.all.current'))
                            <li class="nav-item">
                                <a href="{{ route('customer.all', ['status' => 'active']) }}" class="nav-link {{ request()->routeIs('customer.all') ? 'active' : '' }}">
                                    Current Customers
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('customer.all.former'))
                            <li class="nav-item">
                                <a href="{{ route('customer.all', ['status' => 'inactive']) }}" class="nav-link {{ request()->routeIs('customer.all') ? 'active' : '' }}">
                                    Former Customers
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('customer.add'))
                            <li class="nav-item">
                                <a href="{{ route('customer.add') }}" class="nav-link {{ request()->routeIs('customer.add') ? 'active' : '' }}">
                                    Create Customer
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('supplier.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'active' : '' }}" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'true' : 'false' }}" aria-controls="sidebarSuppliers">
                        <i class="fe fe-users"></i> Suppliers
                    </a>
                    <div class="collapse {{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'show' : '' }}" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('supplier.all'))
                            <li class="nav-item">
                                <a href="{{ route('supplier.all') }}" class="nav-link {{ request()->routeIs('supplier.all') ? 'active' : '' }}">
                                    All Suppliers
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('supplier.add'))
                            <li class="nav-item">
                                <a href="{{ route('supplier.add') }}" class="nav-link {{ request()->routeIs('supplier.add') ? 'active' : '' }}">
                                    Create Supplier
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Website Features
            </h6>

            <ul class="navbar-nav">
                @if(Auth::user()->can('blog.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'active' : '' }}" href="#sidebarBlog" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'true' : 'false' }}" aria-controls="sidebarBlog">
                        <i class="fe fe-feather"></i>Blog
                    </a>
                    <div class="collapse {{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'show' : '' }}" id="sidebarBlog">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('blog.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                                Blog Posts
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('blog.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blog.create') ? 'active' : '' }}" href="{{ route('blog.create') }}">
                                Create Blog
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('service.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'active' : '' }}" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'true' : 'false' }}" aria-controls="sidebarServices">
                        <i class="fe fe-clipboard"></i>Services
                    </a>
                    <div class="collapse {{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'show' : '' }}" id="sidebarServices">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('service.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('service.index') ? 'active' : '' }}" href="{{ route('service.index') }}">
                                    All Services
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('service.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('service.create') ? 'active' : '' }}" href="{{ route('service.create') }}">
                                Create Services
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('slider.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'active' : '' }}" href="#sidebarSlider" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'true' : 'false' }}" aria-controls="sidebarSlider">
                        <i class="fe fe-clipboard"></i>Slider
                    </a>
                    <div class="collapse {{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'show' : '' }}" id="sidebarSlider">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('slider.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('slider.index') ? 'active' : '' }}" href="{{ route('slider.index') }}">
                                    All Slider
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('slider.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('slider.create') ? 'active' : '' }}" href="{{ route('slider.create') }}">
                                Create Slider
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('gallery.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'active' : '' }}" href="#sidebarGallery" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'true' : 'false' }}" aria-controls="sidebarGallery">
                        <i class="fe fe-image"></i>Gallery
                    </a>
                    <div class="collapse {{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'show' : '' }}" id="sidebarGallery">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('gallery.index.photo'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index', ['type' => 'photo']) }}">
                                    Photo Gallery
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('gallery.index.video'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index', ['type' => 'video']) }}">
                                    Video Gallery
                                </a>
                            </li>
                            @endif
                            @if(Auth::user()->can('gallery.create'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.create') ? 'active' : '' }}" href="{{ route('gallery.create') }}">
                                Create Gallery
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('team.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'active' : '' }}" href="#sidebarTeam" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'true' : 'false' }}" aria-controls="sidebarTeam">
                        <i class="fe fe-clipboard"></i>Team
                    </a>
                    <div class="collapse {{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'show' : '' }}" id="sidebarTeam">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('team.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.index') ? 'active' : '' }}" href="{{ route('team.index') }}">
                                    All Team
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                @if(Auth::user()->can('team.create'))
                                <a class="nav-link {{ request()->routeIs('team.create') ? 'active' : '' }}" href="{{ route('team.create') }}">
                                    Create Team
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('testimonial.menu'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'active' : '' }}" href="#sidebarTestimonial" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'true' : 'false' }}" aria-controls="sidebarTestimonial">
                        <i class="fe fe-clipboard"></i>Testimonial
                    </a>
                    <div class="collapse {{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'show' : '' }}" id="sidebarTestimonial">
                        <ul class="nav nav-sm flex-column">
                            @if(Auth::user()->can('testimonial.index'))
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('testimonial.index') ? 'active' : '' }}" href="{{ route('testimonial.index') }}">
                                    All Testimonial
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                @if(Auth::user()->can('testimonial.create'))
                                <a class="nav-link {{ request()->routeIs('testimonial.create') ? 'active' : '' }}" href="{{ route('testimonial.create') }}">
                                    Create Testimonial
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
                @endif

                @if(Auth::user()->can('general.create'))
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('general.create') ? 'active' : '' }}" href="{{ route('general.create') }}">
                        <i class="fe fe-settings"></i>General Settings
                    </a>
                </li>
                @endif
            </ul>

        @else
            <!-- Navbar without permission -->
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="fe fe-layers"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fe fe-grid"></i> Website Home
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasActivity" aria-contrtols="sidebarOffcanvasActivity">
                        <span class="fe fe-bell"></span> Notifications
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Sales Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pos.index') ? 'active' : '' }}" href="{{ route('pos.index') }}">
                        <i class="fe fe-shopping-cart"></i> POS
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['order.index', 'order.history']) ? 'active' : '' }}" href="#sidebarOrder" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['order.index', 'order.history']) ? 'true' : 'false' }}" aria-controls="sidebarOrder">
                        <i class="fe fe-clipboard"></i>Order
                    </a>
                    <div class="collapse {{ request()->routeIs(['order.index', 'order.history']) ? 'show' : '' }}" id="sidebarOrder">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('order.index') ? 'active' : '' }}" href="{{ route('order.index') }}">
                                    Order List <span class="badge bg-primary-soft ms-auto">New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('order.history') ? 'active' : '' }}" href="{{ route('order.history') }}">
                                    Order History
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'active' : '' }}" href="#sidebarReserve" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'true' : 'false' }}" aria-controls="sidebarReserve">
                        <i class="fe fe-clipboard"></i>Reservations
                    </a>
                    <div class="collapse {{ request()->routeIs(['reserve.index', 'reserve.history']) ? 'show' : '' }}" id="sidebarReserve">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reserve.index') ? 'active' : '' }}" href="{{ route('reserve.index') }}">
                                    Reservations List <span class="badge bg-primary-soft ms-auto">New</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('reserve.history') ? 'active' : '' }}" href="{{ route('reserve.history') }}">
                                    Reservations History
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'active' : '' }}" href="#sidebarCategory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'true' : 'false' }}" aria-controls="sidebarCategory">
                        <i class="fe fe-clipboard"></i>Category
                    </a>
                    <div class="collapse {{ request()->routeIs(['category.index', 'category.import', 'category.create', 'category.edit']) ? 'show' : '' }}" id="sidebarCategory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'menu']) }}">
                                    Menu Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'product']) }}">
                                    Product Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'store']) }}">
                                    Store Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index', ['type' => 'blog']) }}">
                                    Blog Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.create') ? 'active' : '' }}" href="{{ route('category.create') }}">
                                    Create Category
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('category.import') ? 'active' : '' }}" href="{{ route('category.import') }}">
                                    Import Category
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'active' : '' }}" href="#sidebarMenu" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'true' : 'false' }}" aria-controls="sidebarMenu">
                        <i class="fe fe-clipboard"></i>Menu
                    </a>
                    <div class="collapse {{ request()->routeIs(['menu.index', 'menu.create', 'menu.edit', 'menu.import']) ? 'show' : '' }}" id="sidebarMenu">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.index') ? 'active' : '' }}" href="{{ route('menu.index') }}">
                                Menu List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.create') ? 'active' : '' }}" href="{{ route('menu.create') }}">
                                Create Menu
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('menu.import') ? 'active' : '' }}" href="{{ route('menu.import') }}">
                                    Import Menu
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'active' : '' }}" href="#sidebarProduct" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'true' : 'false' }}" aria-controls="sidebarProduct">
                        <i class="fe fe-clipboard"></i>Product
                    </a>
                    <div class="collapse {{ request()->routeIs(['product.index', 'product.create', 'product.edit', 'product.import']) ? 'show' : '' }}" id="sidebarProduct">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">
                                Product List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.create') ? 'active' : '' }}" href="{{ route('product.create') }}">
                                Create Product
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('product.import') ? 'active' : '' }}" href="{{ route('product.import') }}">
                                    Import Product
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Inventory Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'active' : '' }}" href="#sidebarProductInventory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'true' : 'false' }}" aria-controls="sidebarProductInventory">
                        <i class="fe fe-clipboard"></i>Product Inventory
                    </a>
                    <div class="collapse {{ request()->routeIs(['inventory.product.index', 'inventory.product.edit', 'inventory.product.expiredproduct', 'inventory.product.outofstock']) ? 'show' : '' }}" id="sidebarProductInventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.index') ? 'active' : '' }}" href="{{ route('inventory.product.index') }}">
                                    Product List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.outofstock') ? 'active' : '' }}" href="{{ route('inventory.product.outofstock') }}">
                                    Product Out of Stock
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.expiredproduct') ? 'active' : '' }}" href="{{ route('inventory.product.expiredproduct') }}">
                                    Exipired Product
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('inventory.product.edit') ? 'active' : '' }}" href="{{ route('inventory.product.edit') }}">
                                    New Inventory
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'active' : '' }}" href="#sidebarStoreInventory" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'true' : 'false' }}" aria-controls="sidebarStoreInventory">
                        <i class="fe fe-dollar-sign"></i> Store Inventory
                    </a>
                    <div class="collapse {{ request()->routeIs(['inventory.store.index', 'inventory.store.add', ]) ? 'show' : '' }}" id="sidebarStoreInventory">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('inventory.store.index') }}" class="nav-link {{ request()->routeIs('inventory.store.index') ? 'active' : '' }}">
                                    Store List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('inventory.store.add') }}" class="nav-link {{ request()->routeIs('inventory.store.add') ? 'active' : '' }}">
                                    Create Store Inventory
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Financial Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'active' : '' }}" href="#sidebarExpenses" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'true' : 'false' }}" aria-controls="sidebarExpenses">
                        <i class="fe fe-clipboard"></i>Expenses
                    </a>
                    <div class="collapse {{ request()->routeIs(['expense.daily', 'expense.weekly', 'expense.monthly', 'expense.yearly', 'expense.create',  'expense.edit']) ? 'show' : '' }}" id="sidebarExpenses">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.create') ? 'active' : '' }}" href="{{ route('expense.create') }}">
                                Create Expense
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.daily') ? 'active' : '' }}" href="{{ route('expense.daily') }}">
                                Daily Expenses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.weekly') ? 'active' : '' }}" href="{{ route('expense.weekly') }}">
                                Weekly Expenses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.monthly') ? 'active' : '' }}" href="{{ route('expense.monthly') }}">
                                Monthly Expenses
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('expense.yearly') ? 'active' : '' }}" href="{{ route('expense.yearly') }}">
                                Yearly Expenses
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'active' : '' }}" href="#sidebarSalaries" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'true' : 'false' }}" aria-controls="sidebarSalaries">
                        <i class="fe fe-dollar-sign"></i> Salaries
                    </a>
                    <div class="collapse {{ request()->routeIs(['salary.advance.all', 'salary.advance.add', 'salary.pay', 'salary.paid', 'salary.pay.details', 'salary.pay.history']) ? 'show' : '' }}" id="sidebarSalaries">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('salary.advance.all') }}" class="nav-link {{ request()->routeIs('salary.advance.all') ? 'active' : '' }}">
                                    All Advance Salaries
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('salary.advance.add') }}" class="nav-link {{ request()->routeIs('salary.advance.add') ? 'active' : '' }}">
                                    Create Advance Salary
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('salary.pay') }}" class="nav-link {{ request()->routeIs('salary.pay') ? 'active' : '' }}">
                                    Pay Salary
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('salary.paid') }}" class="nav-link {{ request()->routeIs('salary.paid') ? 'active' : '' }}">
                                    Last Month Salary
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Management Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'active' : '' }}" href="#sidebarEmployees" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'true' : 'false' }}" aria-controls="sidebarEmployees">
                        <i class="fe fe-users"></i> Employees
                    </a>
                    <div class="collapse {{ request()->routeIs(['employee.all', 'employee.add', 'employee.edit']) ? 'show' : '' }}" id="sidebarEmployees">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('employee.all', ['status' => 'active']) }}" class="nav-link {{ request()->routeIs('employee.all') ? 'active' : '' }}">
                                    Current Employees
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee.all', ['status' => 'inactive']) }}" class="nav-link {{ request()->routeIs('employee.all') ? 'active' : '' }}">
                                    Former Employees
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('employee.add') }}" class="nav-link {{ request()->routeIs('employee.add') ? 'active' : '' }}">
                                    Create Employee
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'active' : '' }}" href="#sidebarAttendance" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'true' : 'false' }}" aria-controls="sidebarAttendance">
                        <i class="fe fe-check-square"></i>Attendance
                    </a>
                    <div class="collapse {{ request()->routeIs(['employee.attendance', 'attendance.take', 'employee.attendance.details', 'employee.attendance.edit']) ? 'show' : '' }}" id="sidebarAttendance">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('employee.attendance') }}" class="nav-link {{ request()->routeIs('employee.attendance') ? 'active' : '' }}">
                                    Attendance List
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('attendance.take') }}" class="nav-link {{ request()->routeIs('attendance.take') ? 'active' : '' }}">
                                    Take Attendance
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'active' : '' }}" href="#sidebarCustomers" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'true' : 'false' }}" aria-controls="sidebarCustomers">
                        <i class="fe fe-users"></i> Customers
                    </a>
                    <div class="collapse {{ request()->routeIs(['customer.all', 'customer.add', 'customer.edit']) ? 'show' : '' }}" id="sidebarCustomers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('customer.all', ['status' => 'active']) }}" class="nav-link {{ request()->routeIs('customer.all') ? 'active' : '' }}">
                                    Current Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.all', ['status' => 'inactive']) }}" class="nav-link {{ request()->routeIs('customer.all') ? 'active' : '' }}">
                                    Former Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('customer.add') }}" class="nav-link {{ request()->routeIs('customer.add') ? 'active' : '' }}">
                                    Create Customer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'active' : '' }}" href="#sidebarSuppliers" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'true' : 'false' }}" aria-controls="sidebarSuppliers">
                        <i class="fe fe-users"></i> Suppliers
                    </a>
                    <div class="collapse {{ request()->routeIs(['supplier.all', 'supplier.add', 'supplier.edit']) ? 'show' : '' }}" id="sidebarSuppliers">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('supplier.all') }}" class="nav-link {{ request()->routeIs('supplier.all') ? 'active' : '' }}">
                                    All Suppliers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('supplier.add') }}" class="nav-link {{ request()->routeIs('supplier.add') ? 'active' : '' }}">
                                    Create Supplier
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Roles & Permissions
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['permission.all', 'permission.import', 'permission.add', 'permission.edit']) ? 'active' : '' }}" href="#sidebarPermissions" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['permission.all', 'permission.import', 'permission.add', 'permission.edit']) ? 'true' : 'false' }}" aria-controls="sidebarPermissions">
                        <i class="fe fe-users"></i> Permissions
                    </a>
                    <div class="collapse {{ request()->routeIs(['permission.all', 'permission.import', 'permission.add', 'permission.edit']) ? 'show' : '' }}" id="sidebarPermissions">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('permission.all') }}" class="nav-link {{ request()->routeIs('permission.all') ? 'active' : '' }}">
                                    All Permissions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission.add') }}" class="nav-link {{ request()->routeIs('permission.add') ? 'active' : '' }}">
                                    Create Permission
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('permission.import') ? 'active' : '' }}" href="{{ route('permission.import') }}">
                                    Import Permission
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['role.all', 'role.add', 'role.edit']) ? 'active' : '' }}" href="#sidebarRoles" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['role.all', 'role.add', 'role.edit']) ? 'true' : 'false' }}" aria-controls="sidebarRoles">
                        <i class="fe fe-users"></i> Roles
                    </a>
                    <div class="collapse {{ request()->routeIs(['role.all', 'role.add', 'role.edit']) ? 'show' : '' }}" id="sidebarRoles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('role.all') }}" class="nav-link {{ request()->routeIs('role.all') ? 'active' : '' }}">
                                    All Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.add') }}" class="nav-link {{ request()->routeIs('role.add') ? 'active' : '' }}">
                                    Create Role
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['role.permission.all', 'role.permission.add', 'role.permission.edit']) ? 'active' : '' }}" href="#sidebarRolePermission" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['role.permission.all', 'role.permission.add', 'role.permission.edit']) ? 'true' : 'false' }}" aria-controls="sidebarRolePermission">
                        <i class="fe fe-users"></i> Role Permissions
                    </a>
                    <div class="collapse {{ request()->routeIs(['role.permission.all', 'role.permission.add', 'role.permission.edit']) ? 'show' : '' }}" id="sidebarRolePermission">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('role.permission.all') }}" class="nav-link {{ request()->routeIs('role.permission.all') ? 'active' : '' }}">
                                    All Role Permissions
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('role.permission.add') }}" class="nav-link {{ request()->routeIs('role.permission.add') ? 'active' : '' }}">
                                    Create Role Permissions
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['admin.employee.role.all', 'admin.employee.role.add', 'admin.employee.role.edit']) ? 'active' : '' }}" href="#sidebarEmployeeRoles" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['admin.employee.role.all', 'admin.employee.role.add', 'admin.employee.role.edit']) ? 'true' : 'false' }}" aria-controls="sidebarEmployeeRoles">
                        <i class="fe fe-users"></i> Employee Roles
                    </a>
                    <div class="collapse {{ request()->routeIs(['admin.employee.role.all', 'admin.employee.role.add', 'admin.employee.role.edit']) ? 'show' : '' }}" id="sidebarEmployeeRoles">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.employee.role.all') }}" class="nav-link {{ request()->routeIs('admin.employee.role.all') ? 'active' : '' }}">
                                    All Employee Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.employee.role.add') }}" class="nav-link {{ request()->routeIs('admin.employee.role.add') ? 'active' : '' }}">
                                    Assign Employee Roles
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Website Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'active' : '' }}" href="#sidebarBlog" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'true' : 'false' }}" aria-controls="sidebarBlog">
                        <i class="fe fe-feather"></i>Blog
                    </a>
                    <div class="collapse {{ request()->routeIs(['blog.index', 'blog.create', 'blog.edit']) ? 'show' : '' }}" id="sidebarBlog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                                Blog Posts
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('blog.create') ? 'active' : '' }}" href="{{ route('blog.create') }}">
                                Create Blog
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'active' : '' }}" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'true' : 'false' }}" aria-controls="sidebarServices">
                        <i class="fe fe-clipboard"></i>Services
                    </a>
                    <div class="collapse {{ request()->routeIs(['service.index', 'service.create', 'service.edit']) ? 'show' : '' }}" id="sidebarServices">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('service.index') ? 'active' : '' }}" href="{{ route('service.index') }}">
                                    All Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('service.create') ? 'active' : '' }}" href="{{ route('service.create') }}">
                                Create Services
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'active' : '' }}" href="#sidebarSlider" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'true' : 'false' }}" aria-controls="sidebarSlider">
                        <i class="fe fe-clipboard"></i>Slider
                    </a>
                    <div class="collapse {{ request()->routeIs(['slider.index', 'slider.create', 'slider.edit']) ? 'show' : '' }}" id="sidebarSlider">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('slider.index') ? 'active' : '' }}" href="{{ route('slider.index') }}">
                                    All Slider
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('slider.create') ? 'active' : '' }}" href="{{ route('slider.create') }}">
                                Create Slider
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'active' : '' }}" href="#sidebarGallery" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'true' : 'false' }}" aria-controls="sidebarGallery">
                        <i class="fe fe-image"></i>Gallery
                    </a>
                    <div class="collapse {{ request()->routeIs(['gallery.index', 'gallery.create', 'gallery.edit']) ? 'show' : '' }}" id="sidebarGallery">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index', ['type' => 'photo']) }}">
                                    Photo Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.index') ? 'active' : '' }}" href="{{ route('gallery.index', ['type' => 'video']) }}">
                                    Video Gallery
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('gallery.create') ? 'active' : '' }}" href="{{ route('gallery.create') }}">
                                Create Gallery
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'active' : '' }}" href="#sidebarTeam" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'true' : 'false' }}" aria-controls="sidebarTeam">
                        <i class="fe fe-clipboard"></i>Team
                    </a>
                    <div class="collapse {{ request()->routeIs(['team.index', 'team.create', 'team.edit']) ? 'show' : '' }}" id="sidebarTeam">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.index') ? 'active' : '' }}" href="{{ route('team.index') }}">
                                    All Team
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('team.create') ? 'active' : '' }}" href="{{ route('team.create') }}">
                                Create Team
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'active' : '' }}" href="#sidebarTestimonial" data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'true' : 'false' }}" aria-controls="sidebarTestimonial">
                        <i class="fe fe-clipboard"></i>Testimonial
                    </a>
                    <div class="collapse {{ request()->routeIs(['testimonial.index', 'testimonial.create', 'testimonial.edit']) ? 'show' : '' }}" id="sidebarTestimonial">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('testimonial.index') ? 'active' : '' }}" href="{{ route('testimonial.index') }}">
                                    All Testimonial
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('testimonial.create') ? 'active' : '' }}" href="{{ route('testimonial.create') }}">
                                Create Testimonial
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Settings
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('general.create') ? 'active' : '' }}" href="{{ route('general.create') }}">
                        <i class="fe fe-settings"></i>General Settings
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('general.create') ? 'active' : '' }}" href="{{ route('general.create') }}">
                        <i class="fe fe-settings"></i>Application Settings
                    </a>
                </li>
            </ul>

            <!-- Divider -->
            <hr class="navbar-divider my-3">

            <!-- Heading -->
            <h6 class="navbar-heading">
                Data Backup Features
            </h6>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('database.index') ? 'active' : '' }}" href="{{ route('database.index') }}">
                        <i class="fe fe-settings"></i>Database Backups
                    </a>
                </li>
            </ul>

        @endif



        <!-- Push content down -->
        <div class="mt-3"></div>


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
                    <img src="{{ (!empty($profileData->photo)) ? url('uploads/admin_images/'.$profileData->photo) : url('uploads/no_image.jpg') }}" class="avatar-img rounded-circle" alt="...">
                </div>
                </a>

                <!-- Menu -->
                <div class="dropdown-menu" aria-labelledby="sidebarIconCopy">
                <a href="{{ route('admin.profile') }}" class="dropdown-item">Profile</a>
                <a href="{{ route('admin.change.password') }}" class="dropdown-item">Change Password</a>
                <hr class="dropdown-divider">
                <a href="{{ route('admin.logout') }}" class="dropdown-item">Sign out</a>
                </div>

            </div>

            <!-- Icon -->
            <a class="navbar-user-link" data-bs-toggle="offcanvas" href="#sidebarOffcanvasSearch" aria-controls="sidebarOffcanvasSearch">
                <span class="icon">
                <i class="fe fe-search"></i>
                </span>
            </a>

        </div>

    </div>

    <!-- / .navbar-collapse -->

  </div>
</nav>
