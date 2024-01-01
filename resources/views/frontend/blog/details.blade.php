@extends('frontend.layouts.frontend')
@section('title', 'Blog Details')

@section('content')

<div class="hero_single inner_pages background-image mb-4" data-background="url('{{ url('uploads/blog_images/'.$blog->thumbnail) }}')" style="height: 550px;">
    <div class="opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.4)">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-10 col-md-8">
                    <h1>{{ $blog->title }}</h1>
                    <p>Cooking delicious and tasty food</p>
                </div>
            </div>
        </div>
    </div>
    <div class="frame gray"></div>
</div>

<div class="container margin_60_40">
    <div class="row">
        <div class="col-lg-9">
            <div class="col-9">
                <div class="postmeta">
                    <ul>
                        <li><a href="#"><i class="fas fa-folder-open"></i></i> {{ $blog->category->name }}</a></li>
                        <li><i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>
            <div class="post-content">
                <div class="dropcaps">
                    <p>{!! $blog->content !!}</p>
                </div>
            </div>
        </div>
        @include('frontend.partials.blogSidebar', [$categories, $latests])
    </div>
</div>
@endsection
