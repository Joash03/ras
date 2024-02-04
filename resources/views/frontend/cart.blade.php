@extends('frontend.layouts.frontend')
@section('title', 'Cart')

@php
$general = \App\Models\General::latest('created_at')->first();
@endphp

@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Order</h1>
        <p>Cooking delicious and tasty food since</p>
    </div>
@endsection
@section('content')

    <div style="background-color: #fcfcfc">
        <div class="container margin_60_40">
            <form action="{{ route('cart.update', auth()->check() ? auth()->user()->id : null) }}" method="POST">
                @csrf
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>
                            <th>
                                Product
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Subtotal
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($carts->isEmpty())
                            @php
                                $totalsubTotal = 0;
                            @endphp
                            <tr>
                                <td  class="item-name h5 text-center">Gallery List is Empty!</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @if (!empty($carts))
                                @php
                                    $totalsubTotal = 0;
                                @endphp

                                @foreach ($carts as $cart)
                                @php
                                    $menuThumbnail = $cart->item_type === 'menu' && $cart->menu ? $cart->menu->thumbnail : null;
                                    $productThumbnail = $cart->item_type === 'product' && $cart->product ? $cart->product->thumbnail : null;

                                    $subTotal = $cart->item_type === 'menu' && $cart->menu && $cart->menu->price ? $cart->quantity * $cart->menu->price : ($cart->item_type === 'product' && $cart->product && $cart->product->sales_price ? $cart->quantity * $cart->product->sales_price : 0);

                                    $totalsubTotal += $subTotal;
                                @endphp
                                    <tr>
                                        <td>
                                            <div class="thumb_cart">
                                                <img width="80" src="{{ $menuThumbnail ? url('uploads/menu_images/'.$menuThumbnail) : url('uploads/product_images/'.$productThumbnail) }}" data-src="{{ $menuThumbnail ? url('uploads/menu_images/'.$menuThumbnail) : url('uploads/product_images/'.$productThumbnail) }}" class="lazy" alt="Image">
                                            </div>
                                            <span class="item_cart">{{ $cart->item_type === 'menu' && $cart->menu ? $cart->menu->name : ($cart->item_type === 'product' && $cart->product ? $cart->product->name : '') }} X {{ $cart->quantity }}</span>
                                        </td>
                                        <td>
                                            <strong>#<span>{{ $cart->item_type === 'menu' && $cart->menu ? $cart->menu->price : ($cart->item_type === 'product' && $cart->product ? $cart->product->sales_price : '') }}</span></strong>
                                        </td>
                                        <td>
                                            <div class="numbers-row">
                                                <input type="number" value="{{ $cart->quantity }}" id="quantity_{{ $cart->id }}" class="qty2" name="quantity_{{ $cart->id }}">
                                                <div class="inc button_inc">+</div>
                                                <div class="dec button_inc">-</div>
                                                <div class="inc button_inc">+</div>
                                                <div class="dec button_inc">-</div>
                                            </div>
                                        </td>
                                        <td>
                                            <strong>#<span>{{ $subTotal }}</span></strong>
                                        </td>
                                        <td class="options">
                                            <a href="{{ route('cart.delete', [$cart->id, auth()->user() ? auth()->user()->id : null]) }}" class="btn btn-link text-danger delete-button" data-item-id="{{ $cart->id }}"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                    </tbody>
                </table>
                <div class="row add_top_30 flex-sm-row-reverse cart_actions">
                    <div class="col-sm-4 text-end">
                        <button type="submit" class="btn_1 outline">Update Cart</button>
                    </div>
                    <div class="col-sm-8">

                    </div>
                </div>
                <!-- /cart_actions -->
            </form>
        </div>
        <!-- /container -->
    </div>

    <div class="box_cart">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                        <li>
                            <span>Subtotal</span> #{{ $totalsubTotal }}.00
                        </li>
                        <li>
                            <span>Delivery fee</span> #{{ $general ? $general->delivery_fee:'' }}.00
                        </li>
                        <li class="text-dark h4">
                            <span>Total</span> #{{ $general ? ($general->delivery_fee + $totalsubTotal):$totalsubTotal }}.00
                        </li>
                    </ul>
                    <a href="{{ route('checkout',  auth()->check() ? auth()->user()->id : null)  }}" class="btn_1 full-width cart">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /box_cart -->
    <script>
        $(document).ready(function () {
            // Handle link click
            $('.delete-button').click(function (e) {
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
@endsection
@section('scripts')
    <script src="{{ asset('assets/frontend/js/specific_shop.js') }}"></script>
@endsection
