@extends('frontend.layouts.frontend')
@section('title', 'Menu')

@php
$general = \App\Models\General::latest('created_at')->first();
$page_id = 1;
@endphp

@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>Menu</h1>
        <p>Cooking delicious and tasty food since</p>
    </div>
@endsection
@section('content')
    <div class="pattern_2">
        <div class="container margin_60_40" data-cues="slideInUp">
            <div class="main_title center">
                <span><em></em></span>
                <h2>Starters</h2>
                <p>Cum doctus civibus efficiantur in imperdiet</p>
            </div>

            <div class="row justify-content-center mb-5">
                @if (!empty($starters))
                    @foreach ($starters as $item)
                    <div class="col-md-4 col-xl-3" data-cue="slideInUp">
                        <div class="item menu_item_grid">
                            <div class="item-img magnific-gallery" data-cue="slideInUp">
                                <img src="{{ url('uploads/menu_images/'.$item->thumbnail) }}" alt="menu item">
                                <div class="content">
                                    <a href="{{ url('uploads/menu_images/'.$item->thumbnail) }}" title="{{ $item->name }}"
                                        data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->category->name }}</p>
                            <div class="price_box">
                                <span class="new_price">#{{ $item->price }}</span>
                                {{-- <span class="old_price">${{ $item->price }}</span> --}}
                            </div>
                                <a href="{{ route('cart.menu.add', ['page_id' => $page_id, 'id' => $item->id]) }}" class="btn_1">add to cart</a>

                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="main_title center" data-cue="slideInUp">
                <span><em></em></span>
                <h2>All Dishes</h2>
                <p>Cum doctus civibus efficiantur in imperdiet</p>
            </div>
            <div class="row justify-content-center mb-3">
                @if (!empty($menus))
                    @foreach ($menus as $item)
                    <div class="col-md-4 col-xl-3" data-cue="slideInUp">
                        <div class="item menu_item_grid">
                            <div class="item-img magnific-gallery" data-cue="slideInUp">
                                <img src="{{ url('uploads/menu_images/'.$item->thumbnail) }}" alt="menu item">
                                <div class="content">
                                    <a href="{{ url('uploads/menu_images/'.$item->thumbnail) }}" title="{{ $item->name }}"
                                        data-effect="mfp-zoom-in"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <h3>{{ $item->name }}</h3>
                            <p>{{ $item->category->name }}</p>
                            <div class="price_box">
                                <span class="new_price">#{{ $item->price }}</span>
                                {{-- <span class="old_price">${{ $item->price }}</span> --}}
                            </div>
                                <a href="{{ route('cart.menu.add', ['page_id' => $page_id, 'id' => $item->id]) }}" class="btn_1">add to cart</a>

                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

        <div class="banner lazy">
            <p class="text-center"><a href="#0" class="btn_1 outline">Download Menu (PDF)</a></p>
        </div>
    </div>
@endsection
