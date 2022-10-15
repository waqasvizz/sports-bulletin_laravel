<!DOCTYPE html>
<html class="loading {{  isset(Auth::user()->theme_mode) && Auth::user()->theme_mode  == 'Light' ? 'light-layout':'dark-layout' }}" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="{{ config('app.name') }} admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, {{ config('app.name') }} admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor Editor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/editors/quill/quill.bubble.css') }}">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">

    {{-- Full Calander --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/fullCalander.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/bootstrap.min.css') }}"> --}}


    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/wizard/bs-stepper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Select2 CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/select/select2.min.css') }}">
    <!-- BEGIN: Select2 CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice-list.css') }}">
    <!-- END: Page CSS-->


    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/pickers/form-pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/ext-component-toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-number-input.css')}}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/assets/css/style.css') }}">
    <!-- END: Custom CSS-->

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <style>
        .alert {
            padding: 15px;
        }

        .alert-success2 {
            background: rgba(40, 199, 111, 0.12) !important;
            color: #28c76f !important;
        }

        .alert-danger2 {
            background: rgba(234, 84, 85, 0.12) !important;
            color: #ea5455 !important;
        }

        .alert-info2 {
            background: rgba(0, 207, 232, 0.12) !important;
            color: #00cfe8 !important;
        }
        
        .icon_image {
            margin-left: 4%;
        }

        .preview {
            /* background: lightgray; */
            display: none;
            border-radius: 10px;
            margin: 10px 0px;
            padding: 15px;
            border: 1px solid lightgray;
            box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.25);
        }

        .preview img {
            border-radius: 50%;
            height: 60px;
            width: 60px;
            margin: 5px;
            border: 2px solid #44b6c0c4;
        }

        .display_images img {
            border-radius: 50%;
            height: 25px;
            width: 25px;
            margin: 5px;
            border: 2px solid #44b6c0c4;
        }

        .display_images_list img {
            border-radius: 50%;
            height: 65px;
            width: 65px;
            margin: 5px;
            border: 2px solid #44b6c0c4;
        }

        .basic-addon {
            padding: 0 !important;
            margin: 0 !important;
        }

        .show_role_name_td {
            padding: 10px;
            background: #f3f2f7;
            border: 1px solid lightgray;
            border-radius: 10px;
        }

        .tp_loader {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 70px;
            color: white;
            transform: translate(-50%, -50%);
        }

        .loaderOverlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            cursor: pointer;
        }

        .avatar-color {
            white-space: nowrap;
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            color: #FFFFFF;
            display: inline-flex;
            font-size: 1rem;
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
        }

        .avatar-color [class*='avatar-status-'] {
            border-radius: 50%;
            width: 11px;
            height: 11px;
            position: absolute;
            right: 12px;
            bottom: 8px;
            border: 1px solid #FFFFFF;
        }

        .avatar-color .avatar-status-online {
            background-color: #28C76F;
        }

        .avatar-color .avatar-status-offline {
            background-color: #ea5455;
        }

        html .pace .pace-progress {
            /* background: #f5f5f5; */
            background: transparent;
        }

        .dark-layout .table-responsive {
            background: transparent;
        }

        .dark-layout .main-menu.menu-light .navigation>li.open:not(.menu-item-closing)>a,
        .dark-layout .main-menu.menu-light .navigation>li.sidebar-group-active>a {
            background-color: #161d31 !important;
        }
        .role-badge{
            color: white;
            background-color: red;
            padding: 7px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bolder;
            min-width: 80px;
            display: inline-block;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- <div class="loading" data-v-3bcd05f2 aria-hidden="true"></div> -->
    <!-- BEGIN: Header-->
    <div class="loaderOverlay">
        <div class="tp_loader"><i class="fa fa-spinner fa-pulse"></i></div>
    </div>
    <!-- <span data-v-3bcd05f2="" aria-hidden="true" class="spinner-grow text-primary">Loading</span> -->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style" id="theme_layout">
                        <i class="ficon" data-feather="{{  isset(Auth::user()->theme_mode) && Auth::user()->theme_mode  == 'Light' ? 'moon':'sun' }}"></i>
                    </a>
                </li>
              
                @include('layouts.notifications')

                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">
                                {{ Auth::user()->first_name.' '.  Auth::user()->last_name }}
                            </span>
                            <span class="user-status">
                                @php
                                if(Auth::user()->role == 1){
                                echo 'Admin';

                                }else if(Auth::user()->role == 2){
                                echo 'Client';

                                }else if(Auth::user()->role == 3){
                                echo 'Staff';

                                }
                                @endphp
                            </span>
                        </div>
                        <span class="avatar">
                            <img class="round" src="{{ is_image_exist(Auth::user()->profile_image) }}" alt="avatar" height="40" width="40">
                            <span class="avatar-status-online"></span>
                        </span>

                    </a>

                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url('editProfile')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 mr-50">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                            </svg>
                            <span>Edit</span>
                        </a>
                        <a class="dropdown-item" href="{{ url('logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>

                    </div>

                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ url('logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
        </div> --}}
        </div>

        </li>
        </ul>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="{{ url('/')}}">
                        <span class="brand-logo">
                            <img src="{{ asset('app-assets/images/ico/apple-icon-120.png') }}" class="congratulations-img-left" alt="card-img-left" />
                            {{--<svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg>--}}
                        </span>
                        {{-- <h2 class="brand-text" style="padding-left: 5px; font-size: 17px !important;">{{ config('app.name') }}</h2> --}}
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            {{-- @if(Cache::has('user-is-online' . Auth::user()->id)) --}}
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                @if (Auth::user()->role == 1)
                <li class="{{ Request::path() == 'admin' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('admin') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                    @elseif (Auth::user()->role == 2)
                <li class="{{ Request::path() == 'client' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('client') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                    @elseif (Auth::user()->role == 3)
                <li class="{{ Request::path() == 'staff' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('staff') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
                    @endif

                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Role">Role</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::path() == 'role' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('role') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                </li>
                <li class="{{ Request::path() == 'role/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('role/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                </li>
            </ul>
            </li>
            @if (Auth::user()->role == 1)
                <li class=" nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="User">User</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'user' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('user') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'user/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('user/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="mail"></i><span class="menu-title text-truncate" data-i18n="Task">Email message</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'emailMessage' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('emailMessage') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'emailMessage/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('emailMessage/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="code"></i><span class="menu-title text-truncate" data-i18n="Task">Email short codes</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'short_codes' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('short_codes') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'short_codes/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('short_codes/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Task">Categories</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'category' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('category') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'category/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('category/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Task">Sub Categories</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'sub_category' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('sub_category') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'sub_category/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('sub_category/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
            @endif

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        @yield('content')
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021
            <span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- Delete modal -->
    <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true" style="display: none">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="smallBody">
                    <form id="delForm" action="" method="post">
                        <div class="modal-body">
                            @csrf
                            @method('DELETE')
                            <h5 class="text-center">Are you sure you want to delete?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button id="form_delete_Btn" type="submit" class="btn btn-danger">Yes, Delete</button>
                            <button id="ajax_delete_Btn" style="display: none;" type="button" class="btn btn-danger">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>


    <script src="{{ asset('app-assets/vendors/js/forms/wizard/bs-stepper.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
    <script src="{{ asset('app-assets/js/tinyScript/tinymyc.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/app-ecommerce-checkout.js')}}"></script>

    <!-- BEGIN: Page Vendor JS-->
    {{-- <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script> --}}
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/moment.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    {{-- Full Calander --}}
    {{-- <script src="{{ asset('app-assets/vendors/js/tables/fullcalander/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('app-assets/vendors/js/tables/fullcalander/fullcalander.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/fullcalander/bootstrap.min.js') }}"></script>



    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/forms/form-select2.js') }}"></script>
    <!-- END: Page JS-->





    
    <!-- BEGIN: Page Vendor Quill JS-->
    <script src="{{ asset('app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('app-assets/js/scripts/forms/form-quill-editor.min.js') }}"></script>






    <!-- BEGIN: Page JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-analytics.js') }}"></script> --}}
    <script src="{{ asset('app-assets/js/scripts/pages/app-invoice-list.js') }}"></script>
    <script src="{{ asset('app-assets/js/script.js') }}"></script>

    <script src="{{ asset('app-assets/js/scripts/sweetalert/sweetalert.min.js') }}"></script>
    <!-- END: Page JS-->
 
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });

        $("#filter_btn").click(function(){
                $('#filter_input_fields').show();
        });

        function get_task_step($id = 0) {
            if ( $id == 1)
                return 'Step 1 (Sales Pick Up)';
            else if ( $id == 2)
                return 'Step 2 (Survey)';
            else if ( $id == 3)
                return 'Step 3 (Proposal)';
            else if ( $id == 4)
                return 'Step 4 (Reschedule)';
            else if ( $id == 5)
                return 'Step 4 (Itemsinfo)';
            else if ( $id == 6)
                return 'Step 4 (Showroominvite)';
            else if ( $id == 7)
                return 'Upload Invoice 30% (First Invoice)';
            else if ( $id == 8)
                return 'Upload Invoice 40% (Second Invoice)';
            else if ( $id == 9)
                return 'Step 4 (ShowroomInvoice)';
            else if ( $id == 10)
                return 'Step 4 (PortalloSection)';
            else if ( $id == 11)
                return 'Upload Invoice 20% (Third Invoice)';
            else if ( $id == 12)
                return 'Upload Invoice 10% (Fourth Invoice)';
            else if ( $id == 13)
                return 'Step 6 (InstallationChecklist)';
            else if ( $id == 14)
                return 'Step 6 (UploadMannual)';
            else if ( $id == 15)
                return 'Step 6 (GuranteeDoc)';
            else if ( $id == 16)
                return 'Step 6 (RectificationPer)';
            else if ( $id == 17)
                return 'Step 6 (ChecklistComplete)';
            else
                return 'Unknown';
        }

        // function getCursorPos(input) {
        //     if ("selectionStart" in input && document.activeElement == input) {
        //         return {
        //             start: input.selectionStart,
        //             end: input.selectionEnd
        //         };
        //     }
        //     else if (input.createTextRange) {
        //         var sel = document.selection.createRange();
        //         if (sel.parentElement() === input) {
        //             var rng = input.createTextRange();
        //             rng.moveToBookmark(sel.getBookmark());
        //             for (var len = 0; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
        //                 len++;
        //             }
        //             rng.setEndPoint("StartToStart", input.createTextRange());
        //             for (var pos = { start: 0, end: len }; rng.compareEndPoints("EndToStart", rng) > 0; rng.moveEnd("character", -1)) {
        //                 pos.start++;
        //                 pos.end++;
        //             }
        //             return pos;
        //         }
        //     }
        //     return -1;
        // }
        
        // function setCursorPos(input, start, end) {
        //     if (arguments.length < 3) end = start;
        //     if ("selectionStart" in input) {
        //         setTimeout(function() {
        //             input.selectionStart = start;
        //             input.selectionEnd = end;
        //         }, 1);
        //     }
        //     else if (input.createTextRange) {
        //         var rng = input.createTextRange();
        //         rng.moveStart("character", start);
        //         rng.collapse();
        //         rng.moveEnd("character", end - start);
        //         rng.select();
        //     }
        // }

        $(document).ready(function() {

            var quill = new Quill('#editor', {
                modules: {
                    toolbar: '#toolbar'
                },
                theme: 'snow'
            });

            $(document).on('submit', '#email_msg_form', function(event) {
                // $("#editorClone").val($(".editor").html());
                $("#editorClone").val($('.ql-editor').html());
                
            });

            // $(":textarea.getPos").on("keyup click", function(e) {
            //     var pos = getCursorPos(this);

            //     console.log(" START ==> " + pos.start);
            //     console.log("   END ==> " + pos.end);

            //     // $(this).siblings(".posStart").val(pos.start);
            //     // $(this).siblings(".posEnd").val(pos.end);
            // }).siblings("input").keydown(function(e){
            //     if (e.keyCode == 13){
            //         $(this).siblings("button").click();
            //         e.preventDefault();
            //     }
            // });
            
            // $("button").click(function(e) {
            //     var par = $(this).parent();
            //     setCursorPos(par.find(":input.getPos")[0], +par.find(".posStart").val(), +par.find(".posEnd").val());
            // });
                
            // $('.ql-editor').keyup(function() {
                // var keyed = $(this).val().replace(/\n/g, '<br/>');
                // console.log($(this).val().indexOf('*'));
                
                // console.log(keyed);
                // var keyed = $(this).val().replace(/\n/g, '<br/>');
                // $("#target").html(keyed);
            // });
                
            var SITEURL = "{{ url('/') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            <?php if(isset($data['calender'])){ ?> 
                
            var posteddata = @json($data['calender']);
            posteddata = JSON.parse(posteddata);
           
                var calendar = $('#full_calendar_events').fullCalendar({
                    editable: true,
                    editable: true,
                    events: posteddata,
                    displayEventTime: true,
                    header:{
                        left:'prev,next today',
                        center:'title',
                        right:'month,agendaWeek,agendaDay'
                    },
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                            event.allDay = true;
                        } else {
                            event.allDay = false;
                        }
                    },
                    selectable: true,
                    selectHelper: true,

                    eventClick: function(info) {
                        var inof_id = info.id;
                        $.ajax({
                            url: SITEURL + "/show-data/"+inof_id,
                            
                            type: "get",
                            dataType: "json",
                            success: function (response) {
                                data = response.data;
                                // console.log(data.creater_user.first_name);
                                var html=""; 
                                
                                html += '<div>';
                            
                                    html += '<p> <b>Creater User name: </b>'+data.creater_user.first_name+ ' '+ data.creater_user.last_name+  '</p>';  
                                    html += '<p> <b> Assign User name: </b>'+data.user.first_name+ ' '+ data.user.last_name+ '</p>';  
                                    html += '<p> <b> Task Status: </b>'+data.task_status+'</p>';  
                                    html += '<p> <b> Task Description: </b>'+data.task_description+'</p>';  
                                    html += '<p> <b> Task Step: </b>'+ get_task_step(data.task_step) +'</p>';  
                                    html += '<p> <b> Task Due Date: </b>'+data.due_date+  '</p>';
                            
                                html += '</div>';  
                                $('.modal-content .modal-body').html(html) ;
                                $('#pracavailable').modal('show');
                            },
                                error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });

            <?php } ?>
            function displayMessage(message) {
            toastr.success(message, 'Event');            
            }

            $("#assign_model_stepone").click(function(){
                $('#step_one_model').modal('show');
            });

            $("#assign_model_steptwo").click(function(){
                $('#step_two_model').modal('show');
            });
            $("#assign_model_stepthree").click(function(){
                $('#step_three_model').modal('show');
            });
            $("#invoice_step_one_model").click(function(){
                $('#invoice_one_model').modal('show');
            });
            $("#assign_model_order_information").click(function(){
                $('#step_four_order_information').modal('show');
            });
            $("#invoice_step_two_model").click(function(){
                $('#invoice_two_model').modal('show');
            });
            $("#invoice_step_three_model").click(function(){
                $('#invoice_three_model').modal('show');
            });
            $("#invoice_step_four_model").click(function(){
                $('#invoice_four_model').modal('show');
            });
            $("#reschedule_model").click(function(){
                $('#reschedule_date_model').modal('show');
            });
            $("#showroom_invoice_model").click(function(){
                $('#showroom_invoice_assign_model').modal('show');
            });
            $("#showroom_invite_email").click(function(){
                $('#showroom_invite_email_task').modal('show');
            });
            $("#portallo_ordered").click(function(){
                $('#portallo_assign_task').modal('show');
            });
            $("#assign_model_stepsix").click(function(){
                $('#step_six_model').modal('show');
            });
            $("#installation_checklist_task_model").click(function(){
                $('#installation_checklist_model').modal('show');
            });
            $("#upload_mannual_document_model").click(function(){
                $('#upload_mannual_model').modal('show');
            });
            $("#upload_gurantee_document_model").click(function(){
                $('#upload_gurantee_model').modal('show');
            });
            $("#rectification_period_model").click(function(){
                $('#rectification_model').modal('show');
            });


            setTimeout(function() {
                $('.alert-success').hide();
            }, 4000);

            // Add email Shortcodes
            $("#emaiil_short_codes").change(function(e) {
                var email_message = $('#email_message').val();
                $("#email_message").val(email_message + " " + e.target.value).focus();
            });

            var pathname = "{{Request::path()}}";

            if (pathname == 'user') {
                getUserAjaxData();
            }
            if (pathname == 'sub_category') {
                getSubCategoryAjaxData();
            }
            if (pathname == 'category') {
                getCategoryAjaxData();
            }

            $(document).on('change', '.userfltr', function(event) {
                getUserAjaxData();
            });

            $(document).on('change', '.sub_cat_fltr', function(event) {
                $('#subCatFltrPage').val(1);
                getSubCategoryAjaxData();
            });
            
            function getUserAjaxData(data) {
                $('.loaderOverlay').fadeIn();
                jQuery.ajax({
                    url: "{{ URL::to('get_users') }}",
                    data: $("#userFilterform").serializeArray(),
                    method: 'POST',
                    dataType: 'html',
                    success: function(response) {
                        $('.loaderOverlay').fadeOut();
                        $("#all_users").html(response);
                    }
                });
            }

            function getCategoryAjaxData(data) {
                console.log(data);
                $('.loaderOverlay').fadeIn();
                jQuery.ajax({
                    url: "{{ URL::to('get_categories') }}",
                    data: $("#catFilterform").serializeArray(),
                    method: 'POST',
                    dataType: 'html',
                    success: function(response) {
                        // alert(response);
                        $('.loaderOverlay').fadeOut();
                        $("#all_categories").html(response);
                    }
                });
            }

            function getSubCategoryAjaxData() {
                $('.loaderOverlay').fadeIn();

                jQuery.ajax({
                    url: "{{ URL::to('get_sub_categories') }}",
                    data: $("#subCatFilterform").serializeArray(),
                    method: 'POST',
                    dataType: 'html',
                    success: function(response) {
                        $('.loaderOverlay').fadeOut();
                        $("#all_sub_categories").html(response);
                    }
                });
            }

            $(document).on('change', '.cat_fltr', function(event) {
                getCategoryAjaxData();
            });


            //Users Links 
            $(document).on('click', '.users_links .pagination a', function(event) {
                event.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                $('#userFltrPage').val(page);
                getUserAjaxData();
            });

            //Categories Links 
            $(document).on('click', '.cat_links .pagination a', function(event) {
                event.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                $('#catFltrPage').val(page);
                getCategoryAjaxData();
            });

            //Items Links 
            $(document).on('click', '.sub_cat_links .pagination a', function(event) {
                event.preventDefault();

                var page = $(this).attr('href').split('page=')[1];
                $('#subCatFltrPage').val(page);
                getSubCategoryAjaxData();
            });

            $("#theme_layout").click(function(event) {
                $.ajax({
                    method: "post",
                    url: "{{ URL::to('theme_mode') }}",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },

                    success: function(data) {},
                    error: function(e) {}
                });

            });

            $(document).on('click', '#delButton,#block_user', function(event) {
                var btn_txt = $(this).text();
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                        title: `Are you sure you want to delete this record?`,
                        icon: "warning",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        }
                    });

                if (btn_txt == 'Block' || btn_txt == 'Unblock') {
                    swal({
                            title: `Are you sure you want to update this record?`,
                            icon: "warning",
                            buttons: ["No", "Yes"],
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                form.submit();
                            }
                        });
                }

            });
            $(document).on('click', '#send_login_button', function(event) {
                var btn_txt = $(this).text();
                var form = $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                var link = $(this).attr('href');
                // alert(link);

                swal({
                        title: `Are you sure you want send login credentials`,
                        icon: "warning",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                    .then(function(value) {
                        if (value) {
                            window.location.href = link;
                        }
                    });

            });

            //Staff Member Status
            $(document).on('change', '.staff_status', function(event) {
                // alert("dfsfsdf");
                $('.alert-danger').hide();
                $('.alert-success').hide(); 
                $('.alert-success-assign').hide();
                var staff_id = $(this).closest(".dropdown").find(".staff_member_id").val();
                var staff_member_status = $(this).val();
                $('.loaderOverlay').fadeIn();
                $.ajax({
                    type: "post",
                    url: "{{ URL::to('post_staff_member_status') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        update_id: staff_id,
                        task_status: staff_member_status,
                    },
                    context: this,
                    success: function(data) {
                        $('.loaderOverlay').fadeOut();
                        if (data.message) {

                            var task_status_name = 'Pending';
                            var task_status_color = '#b4b5af';
                            if(staff_member_status == 1){
                                task_status_name = 'Pending';
                                task_status_color = '#b4b5af';
                            }
                            else if(staff_member_status == 2){
                                task_status_name = 'In Progress';
                                task_status_color = '#455356';
                            }
                            else if(staff_member_status == 3){
                                task_status_name = 'Completed';
                                task_status_color = '#44b6c0';
                            }
                            
                            $('.role-badge-'+staff_id).text(task_status_name);
                            $('.role-badge-'+staff_id).css('background-color', task_status_color);
                            
                            $('.alert-success-assign').show(); 
                            $('.success-message').html(data.message);
                        } else {
                            $('.alert-danger').show();
                            $('.error-message').html(data.records.error);
                        }
                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');

                    },
                    error: function(e) {}
                });
            });

            $(document).on('click', '.step', function(event) {
                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.alert-success2').hide();
                
                var data_target = $(this).attr('data-target');
                data_target = data_target.replace('#', '');
                // alert(data_target);
                follow_steps_active(data_target);
            });

            $(document).on('click', '.sbmt_form_data', function(event) {

                var btn_txt = $(this).text();
                var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
                $(this).html(btn_txt + btn_loader);
                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.loading').show();
                $('.status-div').hide();
                var followStep = $(this).closest("form").find(".follow_steps").val();
                if (followStep == 6) {

                    if ($(this).prop("checked") == true) {
                        $('#installation_checklist').val(1);
                    } else if ($(this).prop("checked") == false) {
                        $('#installation_checklist').val(2);
                    }
                    // var form = $('#step_six_form')[0];
                } 
                // else if (followStep == 7) {
                //     var form = $('#step_seven_form')[0];
                // }
                var form = $(this).closest("form")[0];

                var formData = new FormData(form);
                $(this).attr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('order') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    context: this,
                    dataType: 'json',

                    success: function(data) {
                        console.log(data);

                        $(this).html(btn_txt);
                        $(this).removeAttr('disabled');

                        if (data.success) {
                            $('.loading').hide();
                            $('.alert-success').show();
                            $('.success-message').html(data.message);
                           
                            if (followStep == 2 && data.records.follow_steps == 2) {
                                $('#excel_file_document').css('display', 'block');
                                }
                            if (followStep == 3 && data.records.follow_steps == 4 && data.records.installation_start_date != null) {
                                follow_steps_active('step-four');
                            }
                            if (followStep == 4 && data.records.follow_steps == 5 && data.records.portallo_ordered == 1) {
                                follow_steps_active('step-five');
                            }
                            if (followStep == 6 && data.records.follow_steps == 6  && data.records.installation_checklist_notes != null) {
                                $('#upload_manual_section').css('display', 'block');
                            }
                            if (followStep == 6 && data.records.follow_steps == 6  && data.records.rectification_period_date != null) {
                                $('#project_invoice_info').css('display', 'block');
                            }

                            var html="";
                            if (data.records.showroon_visit_date) {
                                if (data.records.showroom_visit_status == 2) {
                                    html += "<p style='color:green'>(Admin accepted showroom visit date)</p>";
                                } else if (data.records.showroom_visit_status == 4) {
                                    html +=  "<p style='color:rgb(255, 0, 0)'>(Admin change showroom visit date kindly review it)</p>";
                                    $('.showroom_status').hide();
                                    $("#reschedule_div").addClass("ml-2");

                                } else if (data.records.showroom_visit_status == 1){
                                    html +=  "<p style='color:rgb(0, 162, 255)'>(Please wait for admin approval)</p>";
                                }
                                $('.showroom_status_text').html(html);
                            }
                            if (followStep == 6 && data.records.follow_steps == 7) {
                                
                                setTimeout(function() {
                                    location.reload(true);
                                }, 5000);
                            }
                            
                        } else {
                            $('.alert-danger').show();
                            $('.loading').hide();
                            $('.error-message').html(data.records.error);
                        }

                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');
                    },
                    error: function(e) {

                    }
                });
            });

            // Document upload 
            $(document).on('click', '.sbmt_document_file', function(event) {
               event.preventDefault();
                var btn_txt = $(this).text();
                var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
                $(this).html(btn_txt + btn_loader);

                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.loading').show();
                $('.status-div').hide();

                var form = $(this).closest("form")[0];
                
                var formData = new FormData(form);
                
               
                $(this).attr('disabled', 'disabled');

                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('orderasset') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    context: this,
                    // timeout: 600000,
                    dataType: 'json',

                    success: function(data) {
                        var html='';
                        var field_name = '';
                        var records_id = '';
                        for (let index = 0; index < data.records.length; index++) {
                                
                            var source = "{{url('/')}}";
                            source = source+'/'+data.records[index].file_path;
                            field_name = data.records[index].field_name;
                            records_id = data.records[index].user_id;
                            
                            html += '<div class="delete_document document-'+data.records[index].id+'">';
                            html += '<label for="checkout-survey_information" class="heading">Document</label>';
                            html += '<span class="bs-stepper-box ml-2" style="margin-right: 15px;">';
                            html += '<a href="javascript:void(0)" data-id="'+data.records[index].id+'" class="deletebtn" style="margin-left: 5px;">';
                            html +=  '<i data-feather="trash" class="font-medium icons"  type="submit"></i>';
                            html += '</a>';
                            html += '</span>';
                            html += '<span class="bs-stepper-box">';
                            html += '<a class="icons" href="'+source+'" target="_blank" download>';
                            html +=  '<i data-feather="download" class="font-medium"></i>';
                            html +=  '</a>';
                            html += '</span>';
                            html +=  '</div>'; 
                        }                  

                        // $(this).closest("form").append('.showinputfile').append(html);
                        if (field_name != '' && field_name == 'step3_document_file' && records_id == 1) {
                            $(".admin_document_files").append(html);
                        }
                        else if (field_name != '' && field_name == 'step3_document_file' && records_id != 1) {
                            $(".user_document_files").append(html);
                        }
                        else if (field_name != '' && field_name == 'step3_agreement_document' && records_id != 1) {
                            $(".document_agreement").html(html);
                        }
                        else if (field_name != '' && field_name == 'step3_agreement_document' && records_id == 1) {
                            $(".admin_agreement").html(html);
                        }
                        else if (field_name != '' && field_name == 'step2_document' && records_id != 1) {
                            $(".document_excel").append(html);
                        }
                       
                        else if (field_name != '' && field_name == 'step2_document' && records_id == 1) {
                            $(".document_admin_excel").append(html);
                        }
                        else if (field_name != '' && field_name == 'step3_proposal_document' && records_id != 1) {
                            $(".client_proposal").append(html);
                        }
                        else if (field_name != '' && field_name == 'step3_proposal_document' && records_id == 1) {
                            $(".admin_proposal").append(html);
                        }
                        else if (field_name != '' && field_name == 'step6_guarantee_document' && records_id == 1) {
                            $(".gurantee_admin_document").html(html);
                        }
                        else if (field_name != '' && field_name == 'step6_upload_manual' && records_id == 1) {
                            $(".manual_admin_document").html(html);
                        }
                        feather.replace();
                        
                        $(this).html(btn_txt);
                        $(this).removeAttr('disabled');

                        if (data.success) {
                            form.reset(); 
                           
                            
                            $('.loading').hide();
                            $('.alert-success').show();
                            $('.success-message').html(data.message);
                            swal({
                            title: `Document uploaded successfully`,
                            icon: "success",
                            buttons: "OK",
                            dangerMode: false,
                        });
                        if (field_name == 'step2_document' && records_id == 1) {
                                follow_steps_active('step-three');
                        }
                        if (field_name == 'step3_proposal_document' ) {
                            $('#installation_section').show();
                        }
                        if (field_name == 'step6_upload_manual') {
                            $('#gurantee_section').show();
                        }
                        if (field_name == 'step6_guarantee_document') {
                            $('#rectification_period_section').show();
                        }
                        } else {
                            $('.alert-danger').show();
                            $('.loading').hide();
                            $('.error-message').html(data.records.error);
                            
                            $('html,body').animate({
                                    scrollTop: $(".bs-stepper-header").offset().top
                                },
                                'smooth');
                        }

                    },
                    error: function(e) {

                    }
                });
            });

             //Delete File

           $(document).on('click', '.deletebtn', function(event){
            var id = $(this).data("id");
            
            swal({
                    title: `Are you sure you want delete`,
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                })
                .then(function(data) {
                    if (data === true) {
                        $.ajax({
                            type: "delete",
                            url: "{{ URL::to('orderasset') }}/" + id,
                            data: {
                                _token: "{{ csrf_token() }}",
                                id:id,
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('.document-'+id).remove();
                            $('.alert-info3').show();

                                
                                $('html,body').animate({
                                        scrollTop: $(".bs-stepper-header").offset().top
                                    },
                                    'smooth');
                            },
                            error: function(e) {}
                        });
                    } else {
                        $('.loaderOverlay').fadeOut();
                    }
                });
           });


            $(document).on('click', '.task_submit', function(event) {

                // alert("sdfsfs");
                var btn_val = $(this).val();
                $('.alert-danger-assign').hide();
                $('.alert-success-assign').hide();
                $('.loading').show();
                $('.status-div').hide();
                var followStep = $(this).closest("form").find(".task_step").val();
                var form = $(this).closest("form")[0];
                var formData = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: "{{ URL::to('task') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        context: this,
                        // timeout: 600000,
                        dataType: 'json',
                        // data: {
                        //     _token: "{{ csrf_token() }}",
                        //     assign_user_id: assign_user_id,
                        //     due_date: due_date,
                        //     task_description: task_description,
                        //     enquery_id: enquery_id,
                        //     task_step:btn_val
                        // },
                        success: function(data) {
                            console.log(data);
                            if (data.success) {
                                // alert("data");
                                $('.loading').hide();
                                $('.alert-success-assign').show();
                                $('.success-message').html(data.message);
                            } else {
                                $('.alert-danger-assign').show();
                                $('.loading').hide();
                                $('.error-message').html(data.records.error);
                            }
                        },
                        error: function(e) {

                        }
                    });
            });

            $(document).on('change', '.invoice_status_dd', function(event) {
                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.status-div').hide();

                var invoice_id = $(this).closest(".dropdown").find(".invoice_id").val();
                var invoice_status = $(this).val();
                $('.loaderOverlay').fadeIn();
                $.ajax({
                    type: "put",
                    url: "{{ URL::to('invoice') }}/" + invoice_id,
                    data: {
                        _token: "{{ csrf_token() }}",
                        update_id: invoice_id,
                        invoice_status: invoice_status,
                    },
                    success: function(data) {
                        $('.loaderOverlay').fadeOut();
                        console.log(data);
                        if (data.success) {
                            $('.alert-success').show();
                            $('.success-message').html(data.message);
                            if (invoice_status == 2 || data.records.invoice_step == 2) {
                                $('#customer_sale_info').show();
                            } else {
                                $('#customer_sale_info').hide();
                            }
                            if (invoice_status == 2 && data.records.invoice_step == 4) {
                                $('#installation_checkbox').show();
                            } else {
                                $('#installation_checkbox').hide();
                            }
                            if (invoice_status == 2 && data.records.invoice_step == 5) {
                                $('#porlallo').show();
                                // follow_steps_active('step-five');
                            }else if (invoice_status == 2 && data.records.invoice_step == 2) {
                                $('#showroom_form').show();
                            } else if (invoice_status == 2 && data.records.invoice_step == 3) {
                                follow_steps_active('step-six');
                            }else if (invoice_status == 2 && data.records.invoice_step == 4) {
                                $('#installation_checklist_section').show();
                            } else if (invoice_status == 2 && data.records.invoice_step == 2) {
                                alert(data.records.invoice_step);
                            }

                        } else {
                            $('.alert-danger').show();
                            $('.error-message').html(data.records.error);
                        }
                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');

                    },
                    error: function(e) {}
                });
            });

            $(document).on('click', '.send_email_confirmation', function(event){
                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.status-div').hide();
                $('.loaderOverlay').fadeIn();
                var status = $(this).val();

                swal({
                        title: `Are you sure you want send email`,
                        icon: "success",
                        buttons: ["No", "Yes"],
                        dangerMode: true,
                    })
                    .then(function(data) {
                        if (data === true) {
                            $.ajax({
                                type: "post",
                                url: "{{ URL::to('client_confirmation') }}",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    enquery_id: "{{ isset($data['enquery_id'])? $data['enquery_id']: 0 }}",
                                    status: status
                                },
                                dataType: 'json',
                                success: function(data) {
                                    $('.loaderOverlay').fadeOut();
                                    $('.alert-success').show();
                                    $('.success-message').html(data.message);
                                    $('html,body').animate({
                                            scrollTop: $(".bs-stepper-header").offset().top
                                        },
                                        'smooth');
                                },
                                error: function(e) {}
                            });
                        } else {
                            $('.loaderOverlay').fadeOut();
                        }
                    });

            });

            // $(document).on('click', '#customSwitch1', function(event) { 
            $(document).on('click', '.invoice_submit_data', function(event) {
                
                var btn_txt = $(this).text();
                var btn_loader = ' <i class="fa fa-spinner fa-pulse"></i>';
                $(this).html(btn_txt + btn_loader);
                $(this).attr('disabled', 'disabled');

                $('.alert-danger').hide();
                $('.alert-success').hide();
                $('.status-div').hide();
                var followStep = $(this).closest("form").find(".invoice_step").val();
                if (followStep == 1) {
                    if ($(this).prop("checked") == true) {
                        $('#invoice_status').val(1);
                    } else if ($(this).prop("checked") == false) {
                        $('#invoice_status').val(2);
                    }
                    var form = $('#invoice_one_form')[0];
                }
                var form = $(this).closest("form")[0];
                var formData = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "{{ URL::to('invoice') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    context: this,
                    // timeout: 600000,
                    dataType: 'json',
                    success: function(data) {
                        $(this).html(btn_txt);
                        $(this).removeAttr('disabled');
                        if (data.success) {
                            $('.invoice_id_' + data.records.invoice_step).val(data.records.id);
                            $('.alert-success').show();
                            $('.success-message').html(data.message);

                        } else {
                            $('.alert-danger').show();
                            $('.error-message').html(data.records.error);
                        }
                        $('html,body').animate({
                                scrollTop: $(".bs-stepper-header").offset().top
                            },
                            'smooth');
                    },
                    error: function(e) {}
                });

            });
            $(document).on('click', '.btn_submit_status', function(event) {
                $('.alert-danger').hide();
                $('.status-div').hide();
                var invoice_id = $(this).closest(".change_payment_status").find(".invoice_id").val();
                var invoice_status = $(this).val();

                swal({
                    title: `Are you sure you want to confirm  payment sent`,
                    icon: "warning",
                    buttons: ["No", "Yes"],
                    dangerMode: true,
                })
                .then(function(data) {
                    if (data === true) {
                        $.ajax({
                            type: "put",
                            url: "{{ URL::to('invoice') }}/" + invoice_id,
                            data: {
                                _token: "{{ csrf_token() }}",
                                update_id: invoice_id,
                                invoice_status: invoice_status,
                            },
                            success: function(data) {
                                if (data.success) {
                                    // $('.invoice_id_' + data.records.invoice_step).val(data.records.id);
                                    $('.ajax-alert-info2').show();
                                    $("input.btn_submit_status").prop("disabled", true);
                                    $('.loaderOverlay').fadeOut();

                                } else {
                                    $('.alert-danger').show();
                                    $('.error-message').html(data.records.error);
                                }
                                $('html,body').animate({
                                        scrollTop: $(".bs-stepper-header").offset().top
                                    },
                                    'smooth');
                            },
                            error: function(e) {}
                        });

                    } else {
                        location.reload(true);
                        $('.loaderOverlay').fadeOut();
                    }
                });
                

            });


        });
    </script>


    @yield('scripts')
    @yield('notificationScript')

</body>
<!-- END: Body-->

</html>