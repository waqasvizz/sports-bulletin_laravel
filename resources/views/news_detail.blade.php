@section('title', $data['news_detail']->title)
@section('meta_description', strip_tags($data['news_detail']->news_description))
@extends('layouts.webfront')

@section('content')
<main>

    <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box privacy" data-animate-effect="fadeInLeft">
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                        <b>{{ $data['news_detail']->category->title }} - {{ $data['news_detail']->sub_category->title }}</b>
                        <span class="pull-right">{{ date("d M, Y", strtotime($data['news_detail']->news_date)) }}</span>
                    </div>

                    <div class="text-center">
                        <button style="margin-bottom: 10px" class="print_btn btn btn-success"
                            onclick="window.print()"><i style="font-size: 20px" class="fa fa-print"
                                aria-hidden="true"></i></button><br>
                        <img src="{{ is_image_exist($data['news_detail']->image_path) }}" alt="{{ $data['news_detail']->title }}"
                            style="border: 2px solid gray; border-radius: 10px; max-width: 100%; max-height: 500px;">
                    </div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4 text-uppercase text-center">
                        <b>{{ $data['news_detail']->title }}</b>
                    </div>
                    {!! $data['news_detail']->news_description !!}

                    <?php $share_url = url('/news-detail').'/' . $data['news_detail']->news_slug; ?>
                    <div class="row container">
                        <div class="col-md-2"></div>
                        <div class="col-md-2 col-3">

                            <div class="social-sharing">
                                <a href="http://www.facebook.com/sharer.php?u=<?php echo $share_url; ?>"
                                    target="_blank">
                                    <p style="background-color: #3371b7">
                                        <img src="{{ asset('web-assets/images/social-icons/facebook.png') }}"
                                            height="25px" alt="facebook">
                                    </p>
                                </a>
                            </div>

                        </div>
                        <div class="col-md-2 col-3">
                            <div class="social-sharing">
                                <a href="http://twitter.com/share?url=<?php echo $share_url; ?>&text={{ $data['news_detail']->title }}"
                                    target="_blank">
                                    <p style="background-color: #4da7de">
                                        <img src="{{ asset('web-assets/images/social-icons/twitter.png') }}"
                                            height="25px" alt="twitter">
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-3">
                            <div class="social-sharing">
                                <a
                                    href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                    <p style="background-color: #c92619">
                                        <img src="{{ asset('web-assets/images/social-icons/pinterest.png') }}"
                                            height="25px" alt="pinterest">
                                    </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-2 col-3">
                            <div class="social-sharing">
                                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo $share_url; ?>"
                                    target="_blank">
                                    <p style="background-color: #3371b7">
                                        <img src="{{ asset('web-assets/images/social-icons/linkedin.png') }}"
                                            alt="linkedin" height="25px">
                                    </p>
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 animate-box" data-animate-effect="fadeInRight">
                    @include('layouts.webfront_sidebar')
                </div>

            </div>
        </div>
    </div>


    <div class="container-fluid pb-4 pt-5 relevant_news_area">
        <div class="container animate-box">
            <div>
                <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Relevant News</div>
            </div>
            <div class="owl-carousel owl-theme" id="slider2">

                @if(isset($data['relevant']) && count($data['relevant'])>0)
                @foreach($data['relevant'] as $key => $value)
                <div class="item px-2">
                    <div class="fh5co_hover_news_img">
                        <div class="fh5co_news_img">
                            <div class="cat_div" style="position: absolute">
                                <p style="margin-bottom: 0px;"><a href="{{ url('/news') }}/{{ $value->category->slug }}"><b
                                            class="text-uppercase"
                                            style="background: {{ randomColor() }}">{{ $value->category->title }}</b></a></p>
                            </div>
                            <img src="{{ is_image_exist($value->image_path) }}" alt="{{ $value->title }}">
                        </div>
                        <div>
                            <a href="{{ url('/news-detail') }}/{{ $value->news_slug }}"
                                class="d-block fh5co_small_post_heading"><span class="">{{ $value->title }}</span></a>
                            <div class="c_g"><i class="fa fa-clock-o"></i>
                                {{ date("d M, Y", strtotime($value->news_date)) }}</div>
                        </div>
                    </div>
                </div>

                @endforeach
                @endif

            </div>
        </div>
    </div>
</main>
@endsection