

@section('title', Request::path() == '/'? 'Home': @$main_title)
@section('meta_description', 'Checkout for the Latest and Top Sports bulletin News from Pakistan and around the world')
@extends('layouts.webfront')

@section('content')
<main>

    @if(Request::path() == '/')
    <div class="container-fluid top_carousel">
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="12000">
            <div class="carousel-inner row w-100 mx-auto flex-nowrap" role="listbox">
                @if(isset($data) && count($data)>0)
                @foreach($data as $key => $value)
                @php

                @endphp
                <div class="carousel-item top-carousel-item-inner col-md-3 {{ $key == 0? 'active' : '' }}"
                    style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.44), rgba(17, 17, 17, 0.44)), url('{{ is_image_exist($value->image_path) }}');background-size: 100% 100%;">
                    <div class="d-block text-center">
                        <p><span style="background-color: {{ randomColor() }}"><a
                                    href="{{ url('/news') }}/{{ $value->category->slug }}">{{ $value->category->title }}
                                    - </a><a
                                    href="{{ url('/news') }}/{{ $value->category->slug }}/{{ @$value->SubCategory->slug }}">{{ $value->sub_category->title }}</a></span>
                        </p>
                        <h1><a href="{{ url('/news-detail') }}/{{ $value->news_slug }}">{{ $value->title }}</a></h1>
                        <h5>{{ date('l, F d, Y', strtotime($value->news_date)) }}</h5>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <i class="fa fa-chevron-left fa-lg text-muted"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <i class="fa fa-chevron-right fa-lg text-muted"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    @endif

    {{-- @if(Request::path() == '/')
    <div class="container-fluid top_carousel">
        <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="12000">
            <div class="carousel-inner row w-100 mx-auto flex-nowrap" role="listbox">
                @if(isset($data) && count($data)>0)
                    @php
                        $is_div_close = true;
                    @endphp
                @foreach($data as $key => $value)
                @php
                    $is_div_close = false;
                @endphp
                @if ($key == 0 || $key == 4)
                    <div class="carousel-item  col-md-12 {{ $key == 0? 'active' : '' }}">
                        <div class="row">
                @endif
                    <div class="col-md-3 top-carousel-item-inner"
                        style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.44), rgba(17, 17, 17, 0.44)), url('{{ is_image_exist($value->image_path) }}');background-size: 100% 100%;">
                        <div class="d-block text-center">
                            <p><span style="background-color: {{ randomColor() }}"><a
                                        href="{{ url('/news') }}/{{ $value->category->slug }}">{{ $value->category->title }}
                                        - </a><a
                                        href="{{ url('/news') }}/{{ $value->category->slug }}/{{ $value->sub_category->slug }}">{{ $value->sub_category->title }}</a></span>
                            </p>
                            <h1><a href="{{ url('/news-detail') }}/{{ $value->news_slug }}">{{ $value->title }}</a></h1>
                            <h5>{{ date('l, F d, Y', strtotime($value->news_date)) }}</h5>
                        </div>
                    </div>
                @if ($key == 3 || $key == 7)
                    @php
                        $is_div_close = true;
                    @endphp
                    </div>
                </div>
                @endif
                @endforeach
                    @if (!$is_div_close)
                        </div>
                    </div>   
                    @endif
                @endif

            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <i class="fa fa-chevron-left fa-lg text-muted"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
                <i class="fa fa-chevron-right fa-lg text-muted"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    @endif --}}


    <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box privacy" data-animate-effect="fadeInLeft">
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                        <b>{{ Request::path() == '/'? 'Latest News': @$main_title}}</b>
                    </div>
                    <div class="row">

                        @if(isset($data) && count($data)>0)
                        @foreach($data as $key => $value)

                        <div class="col-md-6">
                            <div class="container">
                                <div class="row pb-4 block_item">
                                    <div class="col-md-12">
                                        <a href="{{ url('/news-detail') }}/{{ $value->news_slug }}">
                                            <div class="fh5co_hover_news_img">
                                                <div class="fh5co_news_img">
                                                    <img src="{{ is_image_exist($value->image_path) }}"
                                                        alt="{{ $value->title }}">
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-12 animate-box fadeInUp animated-fast">
                                        <div class="cat_div">
                                            <p style="margin-bottom: 10px;">
                                                <!-- <a href="{{ url('/news') }}/{{ $value->category->slug }}">
                                                    <b class="text-uppercase" style="background: {{ randomColor() }}">{{ $value->category->title }} - {{ $value->sub_category->slug }}</b>
                                                </a> -->

                                                <b class="text-uppercase" style="background: {{ randomColor() }}">
                                                    <a class="text-white"
                                                        href="{{ url('/news') }}/{{ $value->category->slug }}">{{ $value->category->title }}
                                                        - </a>
                                                    <a class="text-white"
                                                        href="{{ url('/news') }}/{{ $value->category->slug }}/{{ $value->sub_category->slug }}">{{ $value->sub_category->title }}</a>
                                                </b>


                                                <span
                                                    class="pull-right">{{ date('d M, Y', strtotime($value->news_date)) }}</span>
                                            </p>
                                        </div>
                                        <a href="{{ url('/news-detail') }}/{{ $value->news_slug }}"
                                            class="fh5co_magna py-2">{{ $value->title }}</a> <br>
                                        <div class="short_desc">{!! strip_tags($value->news_description) !!}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        @endif


                    </div>
                    @if (isset($data) && count($data)>0)
                    {{ $data->links('vendor.pagination.bootstrap-4') }}
                    @else
                    <div class="alert alert-primary">Don't have records!</div>
                    @endif
                </div>

                <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
                    @include('layouts.webfront_sidebar')
                </div>

            </div>
            <div class="row mx-0">
                <div class="col-12 text-center pb-4 pt-4">

                </div>
            </div>
        </div>
    </div>
</main>
@endsection