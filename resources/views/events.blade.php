@section('title', @$main_title)
@section('meta_description', 'Checkout for the Latest and Top Sports bulletin News from Pakistan and around the world')
@extends('layouts.webfront')

@section('content')
<main>
    <div class="container-fluid pb-4 pt-4 paddding">
        <div class="container paddding">
            <div class="row mx-0">
                <div class="col-md-8 animate-box privacy" data-animate-effect="fadeInLeft">
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">
                        <b>{{ @$main_title}}</b>
                    </div>

                    @if(isset($data['event_detail']))

                    <div class="text-center">
                        <button style="margin-bottom: 10px" class="print_btn btn btn-success"
                            onclick="window.print()"><i style="font-size: 20px" class="fa fa-print"
                                aria-hidden="true"></i></button><br>
                        <img src="{{ is_image_exist($data['event_detail']->blog_image) }}"
                            style="border: 2px solid gray; border-radius: 10px; max-width: 100%">
                    </div>
                    <div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4 text-uppercase text-center">
                        <b>{{ $data['event_detail']->blog_title }}</b>
                    </div>
                    {!! $data['event_detail']->blog_description !!}

                    <?php $share_url = url('/events').'/' . $data['event_detail']->blog_slug; ?>
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
                                <a href="http://twitter.com/share?url=<?php echo $share_url; ?>&text={{ $data['event_detail']->blog_title }}"
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
                    @endif

                    @if(isset($data['latest_events']) && count($data['latest_events'])>0)
                    @foreach($data['latest_events'] as $key => $value)

                    <div class="container">
                        <div class="row pb-4 block_item">
                            <div class="col-md-5">
                                <a href="{{ url('/events') }}/{{ $value->blog_slug }}">
                                    <div class="fh5co_hover_news_img">
                                        <div class="fh5co_news_img">
                                            <img src="{{ is_image_exist($value->blog_image) }}"
                                                alt="{{ $value->blog_title }}">
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-7 animate-box fadeInUp animated-fast">
                                <a href="{{ url('/events') }}/{{ $value->blog_slug }}"
                                    class="fh5co_magna py-2">{{ $value->blog_title }}</a> <br>
                                <div class="short_desc">{!! $value->blog_description !!}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif


                    @if (isset($data['latest_events']) && count($data['latest_events'])>0)
                        {{ $data['latest_events']->links('vendor.pagination.bootstrap-4') }}
                    @elseif(isset($data['latest_events']))
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