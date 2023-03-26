
@section('title', 'Analytics')
@extends('layouts.master_dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        
    </div>
    <div class="content-body">
        <section id="dashboard-analytics">
            <div class="match-height">

                <div class="card">
                    <div class="card-header d-flex flex-sm-row flex-column justify-content-md-between align-items-start justify-content-start">
                        <div>
                            <h4 class="card-title">Total Visitors And PageViews</h4>
                            <span class="card-subtitle text-muted">Website Trafic</span>
                        </div>
                        <form action="{{ url('/google-analytics') }}" method="POST">
                            @csrf
                            <div class="d-flex align-items-center">
                                <i class="font-medium-2" data-feather="calendar"></i>
                                <input onchange="this.form.submit()" value="{{ isset($data['requestData']['filter_date'])? date("Y-m-d", strtotime($data['requestData']['filter_date'])):date("Y-m-d") }}" name="filter_date" type="date" class="form-control bg-transparent border-0 " placeholder="YYYY-MM-DD" />
                                {{-- <input type="text" class="form-control flat-picker bg-transparent border-0 shadow-none" placeholder="YYYY-MM-DD" /> --}}
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div id="total-visitors-and-page-views-line-area-chart"></div>

                        <!-- Column Search -->
                        <section id="column-search-datatable">
                            <div class="row">



                                @php
                                    $typeAry = $sessionsAry = '';
                                @endphp
                                @if(isset($data['userTypes']) && count($data['userTypes'])>0)
                                <div class="col-lg-6 col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Sessions By User Type</h4>
                                        </div>
                                        <div class="card-body">
                                            <canvas class="doughnut-user-type-chart-ex chartjs" data-height="275"></canvas>

                                            @php
                                                $totalSessions = array_sum(array_column($data['userTypes'], 'sessions'));
                                            @endphp
                                            @foreach ($data['userTypes'] as $key => $value)
                                                @php
                                                    if(isset($value['sessions'])){
                                                        $data['userTypes'][$key]['sessions'] = round(($value['sessions']/$totalSessions)*100,2);
                                                        $data['userTypes'][$key]['total_sessions'] = $value['sessions'];
                                                        echo '<div class="d-flex justify-content-between mt-3 mb-1">
                                                                <div class="d-flex align-items-center">
                                                                    <i data-feather="monitor" class="font-medium-2 text-primary"></i>
                                                                    <span class="font-weight-bold ml-75 mr-25">'.$value['type'].'</span>
                                                                </div>
                                                                <div>
                                                                    <span><i data-feather="user" class="text-primary"></i> '.$value['sessions'].'</span>
                                                                    <i data-feather="arrow-up" class="text-success"></i>
                                                                </div>
                                                            </div>';
                                                    }
                                                @endphp
                                            @endforeach
                                            @php
                                                $typeAry = array_column($data['userTypes'], 'type');
                                                $sessionsAry = array_column($data['userTypes'], 'sessions');
                                                $typeAry = implode(',', $typeAry);
                                                $sessionsAry = implode(',', $sessionsAry);
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                                @endif



                                <!-- Horizontal Bar Chart Start -->
                                <div class="col-xl-6 col-12">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                                            <div class="header-left">
                                                <p class="card-subtitle text-muted mb-25">Top Browsers</p>
                                                {{-- <h4 class="card-title">$74,123</h4> --}}
                                            </div>
                                            <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                                                {{-- <i data-feather="calendar"></i>
                                                <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pr-0" placeholder="YYYY-MM-DD" /> --}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas class="horizontal-top-browser-bar-chart-ex chartjs" data-height="400"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- Horizontal Bar Chart End -->

                                
                                <div class="col-xl-6 col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">Most Visited Pages</h4>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-most-visited-pages table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Url</th>
                                                        <th>Page views</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data['popular']) && count($data['popular'])>0)
                                                        @foreach ($data['popular'] as $key => $value)
                                                        @php
                                                            $sr_no = $key + 1;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $sr_no }}</td>
                                                            <td><a href="https://sports-bulletin.com{{ $value['url'] }}" target="_blank"><i class="mr-50" data-feather="external-link"></i></a> {{ $value['url'] }}</td>
                                                            <td>{{ $value['pageViews'] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">Top Referrers</h4>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-top-referrers table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Url</th>
                                                        <th>Page views</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data['topReferrers']) && count($data['topReferrers'])>0)
                                                        @foreach ($data['topReferrers'] as $key => $value)
                                                        @php
                                                            $sr_no = $key + 1;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $sr_no }}</td>
                                                            <td><a href="https://sports-bulletin.com{{ $value['url'] }}" target="_blank"><i class="mr-50" data-feather="external-link"></i></a> {{ $value['url'] }}</td>
                                                            <td>{{ $value['pageViews'] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-12">
                                    <div class="card">
                                        <div class="card-header border-bottom">
                                            <h4 class="card-title">Top Counties</h4>
                                        </div>
                                        <div class="card-datatable">
                                            <table class="dt-top-countires table table-responsive">
                                                <thead>
                                                    <tr>
                                                        <th>Sr #</th>
                                                        <th>Sessions</th>
                                                        <th>Pageviews</th>
                                                        <th>Visitors</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($data['countries']) && count($data['countries'])>0)
                                                        @foreach ($data['countries'] as $key => $value)
                                                        @php
                                                            $sr_no = $key + 1;
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $sr_no }}</td>
                                                            <td>{{ $value[0] }}</td>
                                                            <td>{{ $value[1] }}</td>
                                                            <td>{{ $value[2] }}</td>
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                




                            </div>
                        </section>
                        <!--/ Column Search -->

                        
                    </div>
                </div>

            </div>

        </section>

    </div>
</div>
@endsection

@php
$datesAry = $visitorsAry = $pageViewsAry = '';
$previousVisitorsAry = $previousPageViewsAry = '';
$top_browser_bar_chart_label_ary = $top_browser_bar_chart_data_ary = '';

if(isset($data['analyticsData']) && count($data['analyticsData'])>0){
    $datesAry = array_column($data['analyticsData'], 'date');
    $visitorsAry = array_column($data['analyticsData'], 'visitors');
    $pageViewsAry = array_column($data['analyticsData'], 'pageViews');

    foreach ($datesAry as $key => $value) {
        // $datesAry[$key] = date('d-M-Y', strtotime($value));
        $datesAry[$key] = date('d-M', strtotime($value));
    }

    $datesAry = implode(',', $datesAry);
    $visitorsAry = implode(',', $visitorsAry);
    $pageViewsAry = implode(',', $pageViewsAry);
}

if(isset($data['previousAnalyticsData']) && count($data['previousAnalyticsData'])>0){
    $previousVisitorsAry = array_column($data['previousAnalyticsData'], 'visitors');
    $previousPageViewsAry = array_column($data['previousAnalyticsData'], 'pageViews');

    $previousVisitorsAry = implode(',', $previousVisitorsAry);
    $previousPageViewsAry = implode(',', $previousPageViewsAry);
}

if(isset($data['topBrowsers']) && count($data['topBrowsers'])>0){
    $top_browser_bar_chart_label_ary = array_column($data['topBrowsers'], 'browser');
    $top_browser_bar_chart_data_ary = array_column($data['topBrowsers'], 'sessions');

    $top_browser_bar_chart_label_ary = implode(',', $top_browser_bar_chart_label_ary);
    $top_browser_bar_chart_data_ary = implode(',', $top_browser_bar_chart_data_ary);
}


// =============================================================
@endphp

@section('myStyle')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}"> --}}
@endsection

@section('scripts')

    <script>
        var datesDataProvider = "{{ $datesAry }}";
        datesDataProvider = datesDataProvider.split(',');
        datesDataProvider = JSON.stringify(datesDataProvider);
        datesDataProvider = JSON.parse(datesDataProvider);

        var visitorsDataProvider = "{{ $visitorsAry }}";
        visitorsDataProvider = visitorsDataProvider.split(',');
        visitorsDataProvider = JSON.stringify(visitorsDataProvider);
        visitorsDataProvider = JSON.parse(visitorsDataProvider);

        var pageViewsDataProvider = "{{ $pageViewsAry }}";
        pageViewsDataProvider = pageViewsDataProvider.split(',');
        pageViewsDataProvider = JSON.stringify(pageViewsDataProvider);
        pageViewsDataProvider = JSON.parse(pageViewsDataProvider);

        var previousVisitorsDataProvider = "{{ $previousVisitorsAry }}";
        previousVisitorsDataProvider = previousVisitorsDataProvider.split(',');
        previousVisitorsDataProvider = JSON.stringify(previousVisitorsDataProvider);
        previousVisitorsDataProvider = JSON.parse(previousVisitorsDataProvider);

        var previousPageViewsDataProvider = "{{ $previousPageViewsAry }}";
        previousPageViewsDataProvider = previousPageViewsDataProvider.split(',');
        previousPageViewsDataProvider = JSON.stringify(previousPageViewsDataProvider);
        previousPageViewsDataProvider = JSON.parse(previousPageViewsDataProvider);
        
        var doughnut_user_type_chart_ex_label = "{{ $typeAry }}";
        doughnut_user_type_chart_ex_label = doughnut_user_type_chart_ex_label.split(',');
        doughnut_user_type_chart_ex_label = JSON.stringify(doughnut_user_type_chart_ex_label);
        doughnut_user_type_chart_ex_label = JSON.parse(doughnut_user_type_chart_ex_label);

        var doughnut_user_type_chart_ex_data = "{{ $sessionsAry }}";
        doughnut_user_type_chart_ex_data = doughnut_user_type_chart_ex_data.split(',');
        doughnut_user_type_chart_ex_data = JSON.stringify(doughnut_user_type_chart_ex_data);
        doughnut_user_type_chart_ex_data = JSON.parse(doughnut_user_type_chart_ex_data);

        var top_browser_bar_chart_label = "{{ $top_browser_bar_chart_label_ary }}";
        top_browser_bar_chart_label = top_browser_bar_chart_label.split(',');
        top_browser_bar_chart_label = JSON.stringify(top_browser_bar_chart_label);
        top_browser_bar_chart_label = JSON.parse(top_browser_bar_chart_label);

        var top_browser_bar_chart_data = "{{ $top_browser_bar_chart_data_ary }}";
        top_browser_bar_chart_data = top_browser_bar_chart_data.split(',');
        top_browser_bar_chart_data = JSON.stringify(top_browser_bar_chart_data);
        top_browser_bar_chart_data = JSON.parse(top_browser_bar_chart_data);

    </script>
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/chart-apex.js') }}"></script>

    <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script>

    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/tables/table-datatables-advanced.js') }}"></script>

    <script src="{{ asset('js/google_analytics.js') }}"></script>
@endsection