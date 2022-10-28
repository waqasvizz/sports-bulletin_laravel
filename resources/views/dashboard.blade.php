

@php
    // echo '<pre>'; print_r($data['calender']); echo '</pre>'; exit;
@endphp
@section('title', 'Dashboard')
@extends('layouts.master_dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">
        
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row match-height">
                <!-- Subscribers Chart Card starts -->

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-primary p-50 m-0">
                                <a href="{{url('/user')}}" style="color: #44b6c0 !important;">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="font-medium-5"></i>
                                    </div>
                                </a>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ isset($data['users_count']) ? $data['users_count']: 0 }}</h2>
                            <p class="card-text mb-1">Users</p>
                        </div>
                        <div id="gained-chart"></div>
                    </div>
                </div>
                <!-- Subscribers Chart Card ends -->
                {{--
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <a href="{{url('/enquiry_form')}}" style="color: #ff9f43 !important;">
                                    <div class="avatar-content">
                                        <i data-feather="briefcase" class="font-medium-5"></i>
                                    </div>
                                </a>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ isset($data['enquiry_form_count']) ? $data['enquiry_form_count']: 0 }}</h2>
                            <p class="card-text mb-1">Orders</p>
                        </div>
                        <div id="order-chart"></div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <a href="{{url('/task')}}" style="color: #8d007b !important;">
                                    <div class="avatar-content">
                                        <i data-feather="list" class="font-medium-5"></i>
                                    </div>
                                </a>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ isset($data['task_count']) ? $data['task_count']: 0 }}</h2>
                            <p class="card-text mb-1">Tasks</p>
                        </div>
                        <div id="order-chart"></div>
                    </div>
                </div>
                --}}

                {{-- 
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="share-2" class="font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bolder mt-1">{{ isset($data['bids_count']) ? $data['bids_count']: 0 }}</h2>
                            <p class="card-text mb-1">Bids</p>
                        </div>
                        <div id="order-chart"></div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header flex-column align-items-start pb-0">
                            <div class="avatar bg-light-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i data-feather="dollar-sign" class="font-medium-5"></i>
                                </div>
                            </div>
                            <h2 class="font-weight-bolder mt-1">${{ isset($data['revenue_count']) ? $data['revenue_count']: 0 }}</h2>
                            <p class="card-text mb-1">Revenue</p>
                        </div>
                        <div id="order-chart"></div>
                    </div>
                </div> --}}
            </div>

        </section>
        <!-- Dashboard Analytics end -->

    </div>
    <div class="content-body">
       
            <form method="POST" id="taskForm">
                @csrf
                <input name="task" id="taskFltrPage" value="1" type="hidden">
                <input id="taskList" name="taskList"  type="hidden" value="{{@$data['taskList']}}">
                <div class="row" id="filter_input_fields" style="display: none">
                    {{-- @if (Auth::user()->role == 1) --}}
                    {{--<div class="col-md-6 mb-1">
                            <label class="form-label" for="select2-basic">Task assign </label>
                            <select class="taskfltr select2 form-select" name="assign_user_id" id="select2-roles">
                                <option value=""> ---- Choose Staff ---- </option>
                                @foreach($data['tasks_data'] as $key => $item)
                                    <option value="{{ $item['assign_user_id'] }}">{{ $item->user->first_name }} {{ $item->user->last_name }}</option>
                                @endforeach
                            
                            </select>
                        </div>--}}
                    {{-- @endif --}}
                </div>
            </form>

    </div>
</div>
@endsection