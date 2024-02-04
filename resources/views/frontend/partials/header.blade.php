<header class="header clearfix element_to_stick pb-2">
    <div class="container-fluid">
        <div id="logo">
            <a href="{{ route('home') }}">
                <img src="{{ (!empty($general ? $general->logo : '')) ? asset('uploads/general_images/'.$general->logo) : asset('frontend/img/logo_1.png') }}" height="30" alt="" class="logo_normal">
                <img src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo_2.png') }}" height="35" alt="" class="logo_sticky">
            </a>
        </div>
        <ul id="top_menu">
            <li>
                <a href="#0" class="search-overlay-menu-btn">
                    <i class="fas fa-search"></i>
                </a>
            </li>
            <li>
                <div class="dropdown dropdown-cart">
                    <a href="{{ route('getcart', auth()->check() ? auth()->user()->id : null) }}" class="cart_bt">
                        <i class="fas fa-cart-plus"></i>
                        <strong>
                            {{ App\Models\WebCart::where(function ($query) {
                                if (auth()->check()) {
                                    $query->where('user_id', auth()->user()->id);
                                } else {
                                    $query->where('session_key', session()->getId());
                                }
                            })->sum('quantity') }}
                        </strong>
                    </a>
                    <div class="dropdown-menu" style="width: 400px;">
                        <ul>
                            @php
                            $totalPrice = 0;
                            @endphp

                            @if (!empty($carts))
                            @foreach ($carts as $cart)
                            @php
                            $menuThumbnail = $cart->item_type === 'menu' && $cart->menu ? $cart->menu->thumbnail : null;
                            $productThumbnail = $cart->item_type === 'product' && $cart->product ? $cart->product->thumbnail : null;

                            $subTotal = $cart->item_type === 'menu' && $cart->menu && $cart->menu->price ? $cart->quantity * $cart->menu->price : ($cart->item_type === 'product' && $cart->product && $cart->product->sales_price ? $cart->quantity * $cart->product->sales_price : 0);

                            $totalPrice += $subTotal;
                            @endphp
                            <li>
                                <figure>
                                    <img src="{{ $menuThumbnail ? url('uploads/menu_images/'.$menuThumbnail) : url('uploads/product_images/'.$productThumbnail) }}" data-src="{{ $menuThumbnail ? url('uploads/menu_images/'.$menuThumbnail) : url('uploads/product_images/'.$productThumbnail) }}" alt="" width="50" height="50" class="lazy loaded" data-was-processed="true">
                                </figure>
                                <strong>
                                    <span>{{ $cart->item_type === 'menu' && $cart->menu ? $cart->menu->name : ($cart->item_type === 'product' && $cart->product ? $cart->product->name : '') }} x {{ $cart->quantity }}</span>
                                    #{{ $subTotal }}
                                </strong>
                                <span style="justify-content: left; float:right;">
                                    <a href="{{ route('cart.delete', [$cart->id, auth()->user() ? auth()->user()->id : null]) }}" class="btn btn-link text-danger delete-button-header" data-item-id="{{ $cart->id }}"><i class="fas fa-trash"></i></a>

                                </span>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                        <div class="total_drop">
                            <div class="clearfix add_bottom_15">
                                <strong>Total</strong>
                                <span>#{{ $totalPrice }}</span>
                            </div>
                            <a href="{{ route('getcart') }}" class="btn_1 outline btn_cart">View Cart</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <!-- /top_menu -->
        <a href="#" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="#"><img src="{{ asset('frontend/img/logo_1.png') }}" height="50" alt=""></a>
            </div>
            <ul>
                <li class="submenu">
                    <a href="{{ route('home') }}" class="show-submenu">Home</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('about') }}" class="show-submenu">About Us</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('menu') }}"  class="show-submenu">Food Menu</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('product') }}"  class="show-submenu">Products</a>
                </li>
                <li class="submenu">
                    <a href="#" class="show-submenu">Gallery</a>
                    <ul>
                        <li><a href="{{ route('gallery', 'photo') }}">Photo Gallery</a></li>
                        <li><a href="{{ route('gallery', 'video') }}">Video Gallery</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="{{ route('allblogs') }}" class="show-submenu" style="padding-top: 7px; padding-bottom: 7px;">Blog</a>
                </li>
                <li class="submenu">
                    <a href="{{ route('contact') }}" class="show-submenu" style="padding-top: 7px; padding-bottom: 7px;">Contact Us</a>
                </li>
                @guest
                <li><p class="text-center"><a href="{{ route('login') }}" class="btn_1" style="text-color: white; padding-top: 5px; padding-left:20px; padding-bottom: 5px; padding-right:20px;">Sign In</a></p></li>
                <li><p class="text-center"><a href="{{ route('register') }}" class="btn_1" style="text-color: white; padding-top: 5px; padding-left:20px; padding-bottom: 5px; padding-right:20px; ">Sign Up</a></p></li>
                @else
                @php
                $user = auth()->user();
                $url = '';
                if ($user->role === 'admin'){
                    $url = '/admin/dashboard';
                }
                elseif($user->role === 'employee'){
                    $url = '/employee/dashboard';
                }
                elseif($user->role === 'customer'){
                    $url = '/customer/dashboard';
                }
                @endphp
                <li><p class="text-center"><a href="{{ $url }}" class="btn_1" style="padding-top: 5px; padding-left:20px; padding-bottom: 5px; padding-right:20px;">Dashboard</a></p></li>
                <li><p class="text-center"><a class="btn_1" style="padding-top: 5px; padding-left:20px; padding-bottom: 5px; padding-right:20px;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Sign Out') }}</a></p></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                </li>
                @endguest
            </ul>
        </nav>
    </div>
    <!-- Search -->
    <div class="search-overlay-menu">
        <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
        <form role="search" id="searchform" method="get">
            <input value="" name="q" type="search" placeholder="Search..." />
            <button type="submit"><i class="icon_search"></i></button>
        </form>
    </div><!-- End Search -->
</header>

<script>
$(document).ready(function () {
    // Handle link click
    $('.delete-button-header').click(function (e) {
        e.preventDefault(); // Prevent the default link behavior

        var itemId = $(this).data('item-id');
        var url = $(this).attr('href'); // Get the URL from the link

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
                // If confirmed, navigate to the delete URL
                window.location.href = url;
                Swal.fire({
                    title: 'Success',
                    text: 'Item has been deleted successfully!',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonColor: '#CE7F36'
                });
            } else {
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
</header>
