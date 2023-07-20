<script>
    const base_url = "{{ url('/') }}";
    const asset_base_url = "{{ asset('/') }}";
</script>
<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    @if ($_SERVER['DOCUMENT_ROOT'] == '/var/www/vhosts/sports-bulletin.com/public_html')
    
        <!-- publishers.propellerads meta tag start -->
        {{-- <meta name="propeller" content="debd68af98ba3e964e2bbb43f8f023d9"> --}}
        <!-- publishers.propellerads meta tag end -->

        <meta name="google-site-verification" content="7FtPqv37iuqXeRunk8rbu1RxJTJD3rFnH6_fGNZYopk" />
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6768282844435410" crossorigin="anonymous"></script>
        {{-- <script data-ad-client="ca-pub-6768282844435410" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> --}}
    @endif
    <!-- Required meta tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="subject" content="Your window to latest news, analysis and features from Pakistan and the world">
    {{-- <meta name="keywords" content="Sports, News, Pakistan"> --}}
    <meta name="keywords" content="Sports, News, Pakistan, BASEBALL & SOFTBALL, CRICKET LGS, ICE HOCKEY, FOOTBALL, TABLE TENNIS, MARTIAL ARTS, SPORTS NEWS, SQUASH, KABADDI, BADMINTON, TENPIN BOWLING, ARTICLES, BILLARD & SNOOKER, PSB NEWS, OLYMPIC, ATHLETICS, BOXING, CLIMBING, WEIGHTLIFTING, GOLF, CYCLING, POLO, ARCHERY, BASKETBALL, CHESS, VOLLEYBALL, TENNIS, CRICKET, HOCKEY">
    <meta name="description" content="@yield('meta_description')">
    <meta name="robots" content="index, archive">
    {{-- <title>Home - Sport bulletin</title> --}}
    <title>@yield('title') - Sport bulletin</title>
    <link rel="icon" href="{{ asset('web-assets/images/newfavicon.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
        integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="{{ asset('web-assets/css/media_query.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web-assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{ asset('web-assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="{{ asset('web-assets/css/owl.carousel.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web-assets/css/owl.theme.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('web-assets/css/style_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web-assets/css/my_style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('web-assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- Modernizr JS -->
    <script src="{{ asset('web-assets/js/modernizr-3.5.0.min.js') }}"></script>

    @if ($_SERVER['DOCUMENT_ROOT'] == '/var/www/vhosts/sports-bulletin.com/public_html')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179040774-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-179040774-1');
    </script>
    @endif

</head>

<body id="body_html" class="single">

    <div class="text-center top_nav">
        <div class="container">
            <span style="background: green;"><a><i class="fa fa-clock-o"></i>&nbsp;&nbsp; {{ date('l, d M Y') }}</a></span>
            <span class="mobile_hide {{ Request::path() == 'about'? 'active':'' }}"><a href="{{ url('about' )}}">About Us</a></span>
            <span class="mobile_hide {{ Request::path() == 'privacy'? 'active':'' }}"> <a href="{{ url('privacy' )}}">Privacy policy</a></span>
            <span class="mobile_hide {{ Request::path() == 'terms'? 'active':'' }}"> <a href="{{ url('terms' )}}">TERMS AND CONDITIONS</a></span>
            <span class="mobile_hide {{ Request::path() == 'contact_us'? 'active':'' }}"><a href="{{ url('contact_us' )}}">Contact Us</a></span>
        </div>
    </div>
    <div class="container-fluid print_area_logo" style="padding: 15px 20px 15px 20px; background: #f0f0f0;">
        <div class="container">
            <div class="row">


                <div class="col-12 col-md-12 align-self-center fh5co_mediya_right animated wow fadeInUp"
                    style="text-align: center">
                    <a href="{{ url('/') }}"><img src="{{ asset('web-assets/images/logo12.png') }}" alt="img"
                            class="fh5co_logo_width" /></a>
                    <h1 class="website_name"><strong>Sports Bulletin</strong></h1>
                </div>

            </div>
        </div>
    </div>


    <div style="background: #f0f0f0;">
        <div class="container">
            <div class="col-md-4 offset-md-4">
                <input type="text" id="search" class="form-control " placeholder="SEARCH CATEGORIES..." name="search">
                <div class="autocomplete" id="autocomplete"></div>
            </div>
        </div>
    </div>


    <div class="tcontainer" id="breaking_news">
        <div class="ticker-wrap">
            <div class="ticker-move">
                @php
                $breakingNews = \App\Models\News::getNews([
                'status' => 'Published',
                'orderBy_name' => 'news.id',
                'orderBy_value' => 'DESC',
                'paginate' => '10'
                ]);
                @endphp

                @foreach ($breakingNews as $key => $value)
                <div class="ticker-item">
                    <strong>
                        <blink>Breaking News : <span class="glyphicon glyphicon-asterisk"></span></blink>
                    </strong>
                    <a href="{{ url('/news-detail')}}/{{ $value->news_slug }}">{{ $value->title }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <header id="navbar">
        <div class="bottom-area" style="background-color: #fcfcfc">
            <div class="container">
                <div class="menu-nav-icon" style="display: none;">
                    <a class="float-left" href="{{ url('/') }}"><img
                            src="{{ asset('web-assets/images/newfavicon.png') }}" alt="logo" height="40px" /></a>

                    <i class="fa fa-bars" onclick="openNav()"></i>
                </div>

                <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <a class="{{ Request::path() == '/'? 'active':'' }}" href="{{ url('/') }}" class="">Home</a>
                    <a class="{{ Request::path() == 'events'? 'active':'' }}" href="{{ url('/events') }}"
                        class="">Events</a>
                    <a class="{{ Request::path() == 'news/archery'? 'active':'' }}"
                        href="{{ url('/news') }}/archery">Archery</a>
                    <a class="{{ Request::path() == 'news/articles'? 'active':'' }}"
                        href="{{ url('/news') }}/articles">Articles</a>
                    <a class="{{ Request::path() == 'news/athletics'? 'active':'' }}"
                        href="{{ url('/news') }}/athletics">Athletics</a>
                    <a class="{{ Request::path() == 'news/badminton'? 'active':'' }}"
                        href="{{ url('/news') }}/badminton">Badminton</a>
                    <a class="{{ Request::path() == 'our-staff'? 'active':'' }}" href="{{ url('/our-staff') }}">Our
                        Staff</a>
                </div>

                <ul class="main-menu visible-on-click" id="main-menu">

                    <li class="{{ Request::path() == '/'? 'active':'' }}">
                        <a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="{{ Request::path() == 'events'? 'active':'' }}">
                        <a href="{{ url('/events') }}">Events</a>
                    </li>
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" style="padding-top: 0px; padding-bottom: 0px;"
                            href="{{ url('/') }}" id="navbarDropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu clearfix2" aria-labelledby="navbarDropdownMenuLink">


                            @php
                            $categoriesRecords = \App\Models\Categorie::getCategories([
                            'status' => 'Published',
                            'orderBy_name' => 'categories.title',
                            'orderBy_value' => 'ASC',
                            'paginate' => '10'
                            ]);
                            @endphp

                            @foreach ($categoriesRecords as $categoryKey => $categoryValue)
                            <li class="dropdown-submenu" style="display: ruby; position: relative !important;">
                                <a class="dropdown-item dropdown-toggle"
                                    href="{{ url('/news') }}/{{ $categoryValue->slug }}">{{ $categoryValue->title }}</a>
                                <ul class="dropdown-menu">
                                    @php
                                    $subCategoriesRecords = \App\Models\SubCategorie::getSubCategories([
                                    'status' => 'Published',
                                    'category_id' => $categoryValue->id,
                                    'orderBy_name' => 'sub_categories.title',
                                    'orderBy_value' => 'ASC',
                                    'paginate' => '10'
                                    ]);
                                    @endphp
                                    @foreach ($subCategoriesRecords as $subCategoryKey => $subCategoryValue)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ url('/news') }}/{{ $categoryValue->slug }}/{{ $subCategoryValue->slug }}">{{ $subCategoryValue->title }}</a>
                                    </li>
                                    @endforeach
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ url('/news') }}/{{ $categoryValue->slug }}">Show All</a>
                                    </li>
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="{{ Request::path() == 'news/archery'? 'active':'' }}">
                        <a href="{{ url('/news') }}/archery">Archery</a>
                    </li>
                    <li class="{{ Request::path() == 'news/articles'? 'active':'' }}">
                        <a href="{{ url('/news') }}/articles">Articles</a>
                    </li>
                    <li class="{{ Request::path() == 'news/athletics'? 'active':'' }}">
                        <a href="{{ url('/news') }}/athletics">Athletics</a>
                    </li>
                    <li class="{{ Request::path() == 'news/badminton'? 'active':'' }}">
                        <a href="{{ url('/news') }}/badminton">Badminton</a>
                    </li>
                    <li class="{{ Request::path() == 'our-staff'? 'active':'' }}">
                        <a href="{{ url('/our-staff') }}">Our Staff</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>



    @yield('content');

    <div class="container-fluid fh5co_footer_bg pb-3" style="padding-bottom: 50px!important;">
        <div class="container animate-box">
            <div class="row">
                <div class="col-12 spdp_right py-5">
                    <img src="{{ asset('web-assets/images/white_logo1.png') }}" alt="img" class="footer_logo" />
                </div>
                <div class="clearfix"></div>
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="footer_main_title py-3"> About</div>
                    <div class="footer_sub_about pb-3"> A sport is normally characterized as an athletic action that
                        includes
                        a level of rivalry, for example, netball or ball. A few games and numerous sorts of hustling
                        are
                        called sports. An expert at a game is called a competitor. A few people like to watch others
                        play
                        sports.
                    </div>
                    <div class="footer_mediya_icon">
                        <div class="text-center d-inline-block"><a href="https://www.linkedin.com/" target="_blank"
                                class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-linkedin"></i></div>
                            </a></div>
                        <div class="text-center d-inline-block"><a href="https://accounts.google.com/" target="_blank"
                                class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-google-plus"></i></div>
                            </a></div>
                        <div class="text-center d-inline-block"><a href="https://www.twitter.com/" target="_blank"
                                class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-twitter"></i></div>
                            </a></div>
                        <div class="text-center d-inline-block"><a href="https://www.facebook.com/" target="_blank"
                                class="fh5co_display_table_footer">
                                <div class="fh5co_verticle_middle"><i class="fa fa-facebook"></i></div>
                            </a></div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-2">
                    <div class="footer_main_title py-3">Site Information</div>
                    <ul class="footer_menu">
                        <li><a href="{{ url('about' )}}"><i class="fa fa-angle-right"></i>&nbsp;&nbsp; About Us</a></li>
                        <li><a href="{{ url('contact_us' )}}"><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Contact Us</a>
                        </li>
                        <li><a href="{{ url('privacy' )}}"><i class="fa fa-angle-right"></i>&nbsp;&nbsp; Privacy policy</a>
                        </li>
                        <li><a href="{{ url('terms' )}}"><i class="fa fa-angle-right"></i>&nbsp;&nbsp; TERMS & CONDITIONS</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-3 col-lg-2">
                    <div class="footer_main_title py-3"> Category</div>
                    <ul class="footer_menu">
                        @php
                            $categoriesRecords = \App\Models\Categorie::getCategories([
                            'status' => 'Published',
                            'orderBy_name' => 'categories.title',
                            'orderBy_value' => 'ASC',
                            'paginate' => '6'
                            ]);
                        @endphp
                        @foreach ($categoriesRecords as $categoryKey => $categoryValue)
                            <li>
                                <a href="{{ url('/news') }}/{{ $categoryValue->slug }}" class=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp; {{ $categoryValue->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-12 col-md-5 col-lg-4 position_footer_relative">
                    <div class="footer_main_title py-3"> Recent News</div>

                    
                        @php
                            $newsRecords = \App\Models\News::getNews([
                            'status' => 'Published',
                            'orderBy_name' => 'news.id',
                            'orderBy_value' => 'desc',
                            'paginate' => '4'
                            ]);
                        @endphp
                        @foreach ($newsRecords as $newsKey => $newsValue)
                        <div class="footer_makes_sub_font"> {{ date('M d,Y', strtotime($newsValue->news_date)) }}</div>
                        <a href="{{ url('news-detail')}}/{{ $newsValue->news_slug }}" class="footer_post pb-4">{{ $newsValue->title }}</a>
                        @endforeach
                    <div class="footer_position_absolute"><img
                            src="{{ asset('web-assets/images/footer_sub_tipik.png') }}" alt="img"
                            class="width_footer_sub_img" /></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid fh5co_footer_right_reserved">
        <div class="container">
            <div class="row  ">
                <div class="col-12 col-md-6 py-4 Reserved">
                </div>
                <div class="col-12 col-md-6 spdp_right py-4">
                </div>
            </div>
        </div>
    </div>


    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
    </div>
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p style="width: 100%; margin: 0;">
                        <b><span class="text-uppercase mod_ads_title">title</span></b>
                        <a style="color: red; opacity: 1;" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span></a>
                    </p>
                </div>
                <div class="modal-body">
                    <img src="" class="imagepreview" style="width: 100%;">
                    <p class="mod_ads_detail text-justify"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('web-assets/js/owl.carousel.min.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous">
    </script>
    <!-- Waypoints -->
    <script src="{{ asset('web-assets/js/jquery.waypoints.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('web-assets/js/main.js') }}"></script>

</body>

</html>