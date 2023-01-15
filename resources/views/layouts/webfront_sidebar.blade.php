<div class="fh5co_heading fh5co_heading_border_bottom py-2 mb-4">Most Popular</div>



@php
    $popularNews = \App\Models\News::getNews([
        'status' => 'Published',
        'paginate' => '10'
    ]);
@endphp

@foreach ($popularNews as $key => $value)

<div class="container" style="border-bottom: 0px solid grey; margin-bottom: 15px; padding-bottom: 10px;">
    <div class="row ">
        <div class="col-5" style="padding-left: 0px !important;">
            <img src="{{ is_image_exist($value->image_path) }}" alt="{{ $value->title }}" class="fh5co_most_trading">
        </div>
        <div class="col-7 paddding">
            <div class="cat_div">
                <p style="margin-bottom: 5px;">
                    <!-- <a href="{{ $value->category->slug }}">
                        <b class="text-uppercase" style="font-size: 12px; background-color: {{ randomColor() }}">{{ $value->category->title }} - {{ $value->sub_category->title }}</b>
                    </a> -->
                    <b class="text-uppercase" style="background: {{ randomColor() }}">
                        <a class="text-white" href="{{ url('/news') }}/{{ $value->category->slug }}">{{ $value->category->title }} - </a>
                        <a class="text-white" href="{{ url('/news') }}/{{ $value->category->slug }}/{{ $value->sub_category->slug }}">{{ $value->sub_category->title }}</a>
                    </b>
                </p>
            </div>
            <div class="most_fh5co_treding_font"><a href="{{ url('/news-detail') }}/{{ $value->news_slug }}"><b>{{ $value->title }}</b></a></div>
            <div class="most_fh5co_treding_font_123"> {{ $value->news_date }} </div>
        </div>
    </div>
</div>

@endforeach


<div class="fh5co_heading fh5co_heading_border_bottom pt-3 py-2 mb-4">Advertisement</div>



@php
    $ownAdRecords = \App\Models\OwnAd::getOwnAd([
        'status' => 'Published',
        'paginate' => '10'
    ]);
@endphp

@foreach ($ownAdRecords as $key => $value)


<div class="container">
    <div class="row">
        <div class="col-md-12 ads_sidebar_block">
            <p class="text-center" style="margin: 0"><b>{{ $value->own_ad_title }}</b></p>
            <a style="cursor: pointer" class="pop">
                <img style="max-height: 200px;" class="pop"
                    ads_detail="{{ $value->own_ad_description }}"
                    ads_title="{{ $value->own_ad_title }}" src="{{ is_image_exist($value->own_ad_image) }}" alt="{{ $value->own_ad_title }}" width="100%">
            </a>
            <p class="ads_detail">{{ $value->own_ad_description }}</p>
        </div>
    </div>
</div>

@endforeach
