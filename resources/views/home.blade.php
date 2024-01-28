@extends('frontend.layouts.frontend')
@section('title', 'Home')

@section('content')

@php
$general = \App\Models\General::latest('created_at')->first();
$page_id = 0;
@endphp
    <div id="carousel-home">
        <div class="owl-carousel owl-theme" id="slider-carousel">
            @if (!empty($sliders))
                @foreach ($sliders as $slider)
                <div class="owl-slide cover lazy" data-src="{{ url('uploads/slider_images/'.$slider->photo) }}">
                    <!-- ... Your slide content ... -->
                    <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.2)">
                        <div class="container">
                            <div class="row" style="padding-top: 100px; padding-bottom: 0px;">
                                <div class="col-lg-10 m-auto static">
                                    <div class="slide-text white text-center">
                                        <h2 class="owl-slide-animated owl-slide-title">{{ $slider->title }}</h2>
                                        <p class="owl-slide-animated owl-slide-subtitle">
                                            {{ $slider->sub_title }}
                                        </p>
                                        <div style="display: flex; justify-content: center">
                                            <span class="owl-slide-animated owl-slide-cta" style="margin: 5px">
                                                <!-- Button -->
                                                <p class="text-center"><a href="{{ route('about') }}" class="btn_1" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">Learn more</a></p>
                                            </span>
                                            <span class="owl-slide-animated owl-slide-cta" style="margin: 5px">
                                                <!-- Button -->
                                                <p class="text-center"><a href="{{ route('menu') }}" class="btn_1" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">Check Our Menu</a></p>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div id="icon_drag_mobile"></div>
    </div>

    <div class="pattern_2">
        <div class="container margin_120_100 home_intro">
            <div class="row justify-content-center d-flex align-items-center">
                <div class="col-lg-5 text-lg-center d-none d-lg-block" data-cue="slideInUp">
                    <figure>
                        <img src="{{ asset('frontend/img/35.jpg') }}" data-src="{{ asset('frontend/img/35.jpg') }}" width="354" height="440"
                            alt="" class="img-fluid lazy">
                        <a href="https://www.youtube.com/watch?v=MO7Hi_kBBBg" class="btn_play" data-cue="zoomIn"
                            data-delay="500"><span class="pulse_bt"><i class="arrow_triangle-right"></i></span></a>
                    </figure>
                </div>
                <div class="col-lg-5 pt-lg-4" data-cue="slideInUp" data-delay="500">
                    <div class="main_title">
                        <span><em></em></span>
                        <h2>About us</h2>
                        <p>{{ $general ? $general->story_title : '' }}</p>
                    </div>
                    <p>{!! $general ? $general->story_description : '' !!}</p>
                    <a href="{{ route('about') }}" class="btn_1 mt-3" style="padding-top: 11px; padding-bottom: 11px;">Read more</a>
                </div>
            </div>
        </div>

        <div class="container margin_120_100">
            <div class="row">
                <div class="col-xl-4">
                    <a href="{{ route('menu') }}" class="img_container">
                        <img src="{{ asset('frontend/img/15.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>Our Menu</h3>
                            <p>View Our Specialites</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('allblogs') }}" class="img_container">
                        <img src="{{ asset('frontend/img/banner_3.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>Our Blogs</h3>
                            <p>Checkout our latest blogs</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('contact') }}" class="img_container">
                        <img src="{{ asset('frontend/img/13.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>Say Something?</h3>
                            <p>Send us a message</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="#homereservations" class="img_container">
                        <img src="{{ asset('frontend/img/12.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>BOOK A TABLE</h3>
                            <p>Reserve a table for you</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('gallery', 'photo') }}" class="img_container">
                        <img src="{{ asset('frontend/img/14.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>Photo Gallery</h3>
                            <p>See photos from our latest event</p>
                        </div>
                    </a>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('gallery', 'video') }}" class="img_container">
                        <img src="{{ asset('frontend/img/11.jpg') }}" class="lazy">
                        <div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                            <h3>Video Gallery</h3>
                            <p>See videos from our latest event</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: #fcfcfc" id="menu">
        <div class="container margin_120_100" data-cue="slideInUp">
            <div class="main_title center mb-5">
                <span><em></em></span>
                <h2>Our Menu</h2>
            </div>
            <div class="row homepage add_bottom_25">
                <div class="col-xl-8">
                    <div class="row">
                        @if (!empty($menus))
                        @foreach ($menus as $menu)
                        <div class="col-lg-6">
                            <div class="menu_item">
                                <figure class="magnific-gallery" data-cue="slideInUp">
                                    <a href="{{ url('uploads/menu_images/'.$menu->thumbnail) }}" title="{{ $menu->name }}"
                                        data-effect="mfp-zoom-in">
                                        <img src="{{ url('uploads/menu_images/'.$menu->thumbnail) }}"
                                            data-src="{{ url('uploads/menu_images/'.$menu->thumbnail) }}" class="lazy" alt="">
                                    </a>
                                </figure>
                                <div class="menu_title">
                                    <h3>{{ $menu->name }}</h3>
                                    <em>{{ $menu->price }}</em>
                                </div>
                                <p>{{ $menu->category->name }}</p>
                                <a href="{{ route('cart.menu.add', ['page_id' => $page_id, 'id' => $menu->id]) }}" class="btn_1">add to cart</a>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-xl-4">

                    <div class="banner lazy" data-bg="url({{ asset('frontend/img/17.jpg') }})">
                        <div class="wrapper opacity-mask" data-opa city-mask="rgba(0, 0, 0, 0.5)" style="background-color: rgba(0, 0, 0, 0.5);">
                            <div class="text">
                                <small>Special Offer</small>
                                <h3>Burgher Menu $18 only</h3>
                                <p>Hamburgher, Chips, Mix Sausages, Beer, Muffin</p>
                                <a href="reservations.html" class="btn_1">Reserve now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center">
                <span style="margin: 5px">
                    <!-- Button -->
                    <p class="text-center"><a href="{{ route('menu') }}" class="btn_1" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">View more Menu</a></p>
                </span>
                <span style="margin: 5px">
                    <!-- Button -->
                    <p class="text-center"><a href="{{ route('menu') }}" class="btn_1 outline" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">Download Menu (PDF)</a></p>
                </span>
            </div>
        </div>
    </div>
    <!-- /container -->

    <div class="pattern_2 call_section lazy">
        <div class="overlay">
            <div class="container clearfix">
                <div class="row">
                    <div class="col-xl-6 col-lg-5 col-md-6 text-center">
                        <div class="box_1" data-cue="slideInUp">
                            <div class="my-5">
                                <h2>Enjoy<span>a Special Event with us!</span></h2>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                                <a href="{{ route('contact') }}" class="btn_1 mt-3" style="padding-top: 11px; padding-bottom: 11px;">Contact us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-5 col-md-6 text-center">
                        <div class="call_section_img" data-cue="slideInUp">
                            <img src="{{ asset('frontend/img/19.jpg') }}" alt="call" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pattern_calendar" id="homereservations">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12" data-cue="slideInUp">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>Reserve a table</h2>
                            <p>or Call us at {{$general ? $general->primary_phone:''}}</p>
                        </div>
                        <div id="wizard_container">
                            <form action="{{ route('reserve') }}" method="POST">
                                @csrf
                                <input type="text" name="websiste" id="website" value="">
                                <div id="middle-wizard">
                                    <div class="step">
                                        <h3 class="main_question"><strong>1/3</strong> Please Select a date</h3>
                                        <div class="form-group">
                                            <input type="hidden" name="date" id="datepicker_field"
                                                class="required">
                                        </div>
                                        <div id="DatePicker"></div>
                                    </div>
                                    <!-- /step-->
                                    <div class="step">
                                        <h3 class="main_question"><strong>2/3</strong> Select time and guests</h3>
                                        <div class="step_wrapper">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <h4>Time</h4>
                                                        <input class="form-control required" type="time" name="time" id="time" placeholder="00:00">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <h4>Number of People?</h4>
                                                        <input class="form-control required" type="number" name="people" id="people" placeholder="00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit step">
                                        <h3 class="main_question"><strong>3/3</strong> Please fill with your details
                                        </h3>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control required"
                                                placeholder="First and Last Name">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="email" name="email"
                                                        class="form-control required" placeholder="Your Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" name="phone"
                                                        class="form-control required" placeholder="Your Telephone">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <textarea class="form-control" name="description"
                                                placeholder="Please provide any additional info"></textarea>
                                        </div>
                                        {{-- <div class="form-group terms">
                                            <label class="container_check">Please accept our <a href="#"
                                                    data-bs-toggle="modal" data-bs-target="#terms-txt">Terms and
                                                    conditions</a>
                                                <input type="checkbox" name="terms" value="Yes" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div id="bottom-wizard">
                                    <button type="button" name="backward" class="backward">Prev</button>
                                    <button type="button" name="forward" class="forward">Next</button>
                                    <button type="submit" name="process" class="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: #fcfcfc" id="product">
        <div class="container margin_120_100" data-cue="slideInUp">
            <div class="main_title center mb-5">
                <span><em></em></span>
                <h2>Our Products</h2>
            </div>
            <div class="row homepage add_bottom_25">
                <div class="col-xl-8">
                    <div class="row">
                        @if (!empty($products))
                        @foreach ($products as $product)
                        <div class="col-lg-6">
                            <div class="menu_item">
                                <figure class="magnific-gallery" data-cue="slideInUp">
                                    <a href="{{ url('uploads/product_images/'.$product->thumbnail) }}" title="{{ $product->name }}"
                                        data-effect="mfp-zoom-in">
                                        <img src="{{ url('uploads/product_images/'.$product->thumbnail) }}"
                                            data-src="{{ url('uploads/product_images/'.$product->thumbnail) }}" class="lazy" alt="">
                                    </a>
                                </figure>
                                <div class="menu_title">
                                    <h3>{{ $product->name }}</h3>
                                    <em>{{ $product->sales_price }}</em>
                                </div>
                                <p>{{ $product->category->name }}</p>
                                <a href="{{ route('cart.product.add', ['page_id' => $page_id, 'id' => $product->id]) }}" class="btn_1">add to cart</a>

                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-xl-4">

                    <div class="banner lazy" data-bg="url({{ asset('frontend/img/17.jpg') }})">
                        <div class="wrapper opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)" style="background-color: rgba(0, 0, 0, 0.5);">
                            <div class="text">
                                <small>Special Offer</small>
                                <h3>Burgher Menu $18 only</h3>
                                <p>Hamburgher, Chips, Mix Sausages, Beer, Muffin</p>
                                <a href="reservations.html" class="btn_1">Reserve now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: center">
                <span style="margin: 5px">
                    <!-- Button -->
                    <p class="text-center"><a href="{{ route('product') }}" class="btn_1" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">View more Product</a></p>
                </span>
                <span style="margin: 5px">
                    <!-- Button -->
                    <p class="text-center"><a href="{{ route('product') }}" class="btn_1 outline" data-cue="zoomIn" style="padding-top: 11px; padding-bottom: 11px;">Download Product (PDF)</a></p>
                </span>
            </div>
        </div>
    </div>
    <!-- /container -->

    <script>
        $(document).ready(function () {
            var owl = $('#slider-carousel');
            owl.owlCarousel({
                items: 1, // Display one item at a time
                loop: true, // Enable loop
                autoplay: false, // Disable Owl Carousel autoplay
                autoplayTimeout: 7000, // Auto-play interval in milliseconds (7 seconds)
                autoplayHoverPause: true, // Pause on hover
            });

            function goToNextSlide() {
                owl.trigger('next.owl.carousel');
            }

            // Start the auto-advance interval
            var intervalId = setInterval(goToNextSlide, 7000); // Advance every 7 seconds

            // Stop the auto-advance interval when the user interacts with the carousel
            owl.on('mousedown', function () {
                clearInterval(intervalId);
            });
        });
    </script>
@endsection
