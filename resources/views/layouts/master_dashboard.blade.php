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
                                @foreach (Auth::user()->getRoleNames() as $role_key => $role_name)
                                    {{ $role_name }}
                                @endforeach
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

                <li class="{{ Request::path() == 'dashboard' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a>
            

                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i data-feather="more-horizontal"></i>
                </li>

        {{--
                <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Role">Role</span></a>
                        <ul class="menu-content">
                            <li class="{{ Request::path() == 'role' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('role') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                </li>
                <li class="{{ Request::path() == 'role/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('role/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                </li>
            </ul>
            </li>

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
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Task">Permission</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'permission' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('permission') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'permission/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('permission/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                
                <li class="{{ Request::path() == 'assign_permission' ? 'active' : '' }} nav-item">
                    <a class="d-flex align-items-center" href="{{ url('assign_permission') }}"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Assign Permission</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Task">Menu</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'menu' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('menu') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'menu/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('menu/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="d-flex align-items-center" href="#"><i data-feather="list"></i><span class="menu-title text-truncate" data-i18n="Task">Sub Menu</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::path() == 'sub_menu' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('sub_menu') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="List">List</span></a>
                        </li>
                        <li class="{{ Request::path() == 'sub_menu/create' ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ url('sub_menu/create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Add">Add</span></a>
                        </li>
                    </ul>
                </li>
            --}}

            @php
                $sub_menu = false;
                $data_arr = \App\Models\Menu::getMenus();
                $request_url = Request::path();
            @endphp
            
            @foreach ($data_arr as $key => $data_obj)
                @php
                    $childs_menu = $data_obj->sub_menus->pluck('slug','slug');
                @endphp
                @canany($childs_menu)
                    @php
                        $childs_count = $data_obj->sub_menus->count();
                        // $class = ($request_url == $data_obj->url) ? 'active' : '';
                        $slug =  str_replace_first('/', '', $data_obj->url); 
                        $class = (strpos(Request::path(), $slug) !== false) ? 'active' : '';
                        // echo '<pre>';print_r($childs_menu);'</pre>';
                    @endphp
                    <li class="{{ $class }} nav-item">
                        <a class="d-flex align-items-center" href="{{ url($data_obj->url) }}">
                            <i data-feather="list"></i>
                            <span class="menu-title text-truncate" data-i18n="Dashboards">{{ $data_obj->title }}</span>
                        </a>

                        @if ($childs_count > 0 )
                            <ul class="menu-content">                    
                                @foreach ($data_obj->sub_menus as $key => $sub_menu_obj)
                                    @can($sub_menu_obj->slug)
                                        @php
                                        // $class = ($request_url == $sub_menu_obj->url) ? 'active' : '';
                                        $slug =  str_replace_first('/', '', $sub_menu_obj->url);
                                        $class = ($request_url == $slug) ? 'active' : '';
                                        @endphp
                                        <li class="{{ $class }}">
                                            <a class="d-flex align-items-center" href="{{ url($sub_menu_obj->url) }}">
                                                <i data-feather="circle"></i>
                                                <span class="menu-item text-truncate" data-i18n="{{ $sub_menu_obj->title }}">{{ $sub_menu_obj->title }}</span>
                                            </a>
                                        </li>
                                    @endcan
                                @endforeach
                            </ul>
                        @endif  
                    </li>
                @endcan
            @endforeach

                {{--

                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="mail"></i>
                            <span class="menu-title text-truncate" data-i18n="Task">Email message</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ Request::path() == 'emailMessage' ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url('emailMessage') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="List">List</span>
                                </a>
                            </li>
                            <li class="{{ Request::path() == 'emailMessage/create' ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ url('emailMessage/create') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate" data-i18n="Add">Add</span>
                                </a>
                            </li>
                        </ul>
                    </li>


                echo "<pre>";
                echo "deee"."<br>";
                print_r($data['menus']);
                echo "</pre>";
                exit("@@@@");
                --}}

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
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- /\b<find_string>\b/ --}}
    @if (preg_match('/\bcategory\b/', Request::path() ))
        <!-- Category Script -->
        <script src="{{ asset('js/category.js') }}"></script>
    @elseif (preg_match('/\bsub_category\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/sub_category.js') }}"></script>
    @elseif (preg_match('/\buser\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/user.js') }}"></script>
    @elseif (preg_match('/\bmenu\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/menu.js') }}"></script>
    @elseif (preg_match('/\bsub_menu\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/sub_menu.js') }}"></script>
    @elseif (preg_match('/\bpermission\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/permission.js') }}"></script>
    @elseif (preg_match('/\bassign_permission\b/', Request::path() ))
        <!-- Sub Category Script -->
        <script src="{{ asset('js/assign_permission.js') }}"></script>
    @endif
   
    @yield('scripts')
    @yield('notificationScript')

</body>
<!-- END: Body-->

</html>