@extends('frontend.layouts.frontend')
@section('title', 'About')

@section('breadcrumb')
    <div class="col-xl-9 col-lg-10 col-md-8">
        <h1>About</h1>
        <p>Cooking delicious and tasty food since</p>
    </div>
@endsection

@php
$general = \App\Models\General::latest('created_at')->first();
@endphp

@section('content')
    <div class="pattern_2">
        <div class="container margin_120_100 home_intro">
            <div class="row justify-content-center text-center">
                <div class="col-lg-7" data-cue="slideInUp" data-delay="500">
                    <div class="main_title center">
                        <span><em></em></span>
                        <h2>Our Story</h2>
                        <p>{{ $general ? $general->story_title:'' }}</p>
                    </div>
                    <p>{!! $general ? $general->story_description:'' !!}</p>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: #fcfcfc">
        <div class="container margin_120_100">
            <div class="row flex-lg-row-reverse">
                <div class="col-lg-5 offset-lg-1 align-self-center mb-4 mb-md-0">
                    <div class="intro_txt" data-cue="slideInUp" data-delay="500">
                        <div class="main_title">
                            <span><em></em></span>
                            <h2>Why Choose Foore</h2>
                        </div>
                        <p>{!! $general ? $general->why_choose_us:'' !!}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">
                            @if (!empty($services))
                                @foreach ($services as $item)
                                    @if ($loop->index < 2)
                                    <div class="box_how" data-cue="slideInUp">
                                        <figure><img src="{{ url('uploads/service_images/'.$item->thumbnail) }}" data-src="{{ url('uploads/service_images/'.$item->thumbnail) }}"
                                                alt="" width="100" height="110" class="lazy"></figure>
                                        <h3>{{ $item->name }}</h3>
                                        <p>{!! $item->description !!}</p>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                        <div class="col-lg-6 align-self-center">
                            @if (!empty($services))
                                @foreach ($services as $item)
                                    @if ($loop->index > 1)
                                    <div class="box_how" data-cue="slideInUp">
                                        <figure><img src="{{ url('uploads/service_images/'.$item->thumbnail) }}" data-src="{{ url('uploads/service_images/'.$item->thumbnail) }}"
                                                alt="" width="100" height="110" class="lazy"></figure>
                                        <h3>{{ $item->name }}</h3>
                                        <p>{!! $item->description !!}</p>
                                    </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pattern_2">
        <div class="container margin_120_100">
            <div class="main_title center mb-5">
                <span><em></em></span>
                <h2>Chefs and Team</h2>
            </div>
            <div id="staff" class="owl-carousel owl-theme">
                @if (!empty($teams))
                    @foreach ($teams as $item)
                    <div class="item">
                        <a href="#0">
                            <div class="title">
                                <h4>{{ $item->name }}<em>{{ $item->designation }}</em></h4>
                            </div><img src="{{ url('uploads/team_images/'.$item->thumbnail) }}" data-src="{{ url('uploads/team_images/'.$item->thumbnail) }}" alt="" width="350" height="500">
                        </a>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
