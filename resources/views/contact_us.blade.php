@section('title', 'Contact Us')
@section('meta_description', 'A sport is normally characterized as an athletic action that includes a level of rivalry, for example, netball or ball. A few games and numerous sorts of hustling are called sports. An expert at a game is called a competitor. A few people like to watch others play sports.')
@extends('layouts.webfront')

@section('content')
<main>
<div class="container-fluid contact_us_bg_img">
        <div class="container">
            <div class="row">
                <div class="col-9 col-lg-10 col-md-9 col-xs-12">
                    <a href="javascript:void(0)" class="fh5co_con_123"><i class="fa fa-home"></i></a>
                    <a href="javascript:void(0)" class="fh5co_con pt-2">Abdul Jabbar Khan</a>
                </div>
                <div class="col-3 col-lg-2 col-md-3 col-xs-12">
                    <img style="float:right; width: 100%; border-radius: 10px"
                         alt="Abdul Jabbar Khan"
                         src="{{ asset('web-assets/upload/contactus/2793-2019-10-23.jpg') }}">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid  fh5co_fh5co_bg_contcat">
        <div class="container">
            <div class="row py-4">
                <div class="col-md-4 py-3">
                    <div class="row fh5co_contact_us_no_icon_difh5co_hover">
                        <div class="col-3 fh5co_contact_us_no_icon_difh5co_hover_1">
                            <div class="fh5co_contact_us_no_icon_div"><span><i class="fa fa-phone"></i></span></div>
                        </div>
                        <div class="col-9 align-self-center fh5co_contact_us_no_icon_difh5co_hover_2">
                            <span class="c_g d-block">Call Us</span>
                            <span class="d-block c_g fh5co_contact_us_no_text">0092-333-5110520 </span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="row fh5co_contact_us_no_icon_difh5co_hover">
                        <div class="col-3 fh5co_contact_us_no_icon_difh5co_hover_1">
                            <div class="fh5co_contact_us_no_icon_div"><span><i class="fa fa-envelope"></i></span></div>
                        </div>
                        <div class="col-9 align-self-center fh5co_contact_us_no_icon_difh5co_hover_2">
                            <span class="c_g d-block">Have any questions?</span>
                            <span class="d-block c_g fh5co_contact_us_no_text">info@sports-bulletin.com</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-md-4 py-3">
                    <div class="row fh5co_contact_us_no_icon_difh5co_hover">
                        <div class="col-3 fh5co_contact_us_no_icon_difh5co_hover_1">
                            <div class="fh5co_contact_us_no_icon_div"><span><i class="fa fa-map-marker"></i></span>
                            </div>
                        </div>
                        <div class="col-9 align-self-center fh5co_contact_us_no_icon_difh5co_hover_2">
                            <span class="c_g d-block">Address</span>
                            <span class="d-block c_g fh5co_contact_us_no_text">Islamabad, Pakistan</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-4">
        <div class="container">
            <div class="col-12 text-center contact_margin_svnit ">
                <div class="text-center fh5co_heading py-2">Contact Us</div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    
                    @if (Session::has('message'))
                        <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
                    @endif
                    @if (Session::has('error_message'))
                        <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
                    @endif

                    <form class="row" id="fh5co_contact_form" method="post" action="{{ url('contactUsSubmit') }}">

                        @csrf
                        <div class="col-12 py-3">
                            <input type="text" name="name" class="form-control fh5co_contact_text_box" required
                                   placeholder="Enter Your Name"/>
                        </div>
                        <div class="col-6 py-3">
                            <input type="email" name="email" class="form-control fh5co_contact_text_box" required
                                   placeholder="E-mail"/>
                        </div>
                        <div class="col-6 py-3">
                            <input type="text" name="subject" class="form-control fh5co_contact_text_box" required
                                   placeholder="Subject"/>
                        </div>
                        <div class="col-12 py-3">
                        <textarea name="message" class="form-control fh5co_contacts_message" placeholder="Message"
                                  required></textarea>
                        </div>
                        <!-- <div class="col-12 py-3">
                            <div id="success_msg" class="alert alert-success"></div>
                            <div id="error_msg" class="alert alert-danger"></div>
                        </div> -->
                        <div class="col-12 py-3 text-center">
                            <img id="load_img" alt="loading" style="display: none;">
                            <button type="submit" class="btn contact_btn" id="send_btn">Send Message</button>
                            <!--                        <a href="javascript:void(0)" class="btn contact_btn">Send Message</a>-->
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-6 align-self-center">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3168.639290621062!2d-122.08624618469247!3d37.421999879825215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sbe!4v1514861541665"
                            class="map_sss" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- <script src="js/jquery.form.js"></script> -->

</main>
@endsection