@section('title', 'News List')
@extends('layouts.master_dashboard')

@section('content')

<div class="content-wrapper">
    <div class="content-header row">

    </div>
    <div class="content-body">

        <!-- Select2 Start  -->
        <section class="basic-select2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Filter News</h4>
                        </div>
                        
                        <div class="card-body">
                            <form method="GET" id="filterForm" action="{{ url('/news') }}">
                                @csrf
                                <input name="page" id="filterPage" value="1" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
                                        
                                        <label class="form-label" for="select2-basic">Status</label>
                                        <select class="filterForm select2 form-select" name="status" id="select2-account-menu-status">
                                            <option value=""> ---- Choose Status ---- </option>
                                            @if (isset($data['statuses']) && count($data['statuses']) > 0 )
                                                @foreach ($data['statuses'] as $key => $status_obj) 
                                                    <option value="{{$status_obj}}">{{$status_obj}}</option>
                                                @endforeach
                                            @endif
                                        </select>
    
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Select2 End -->
        
        @if (Session::has('message'))
        <div class="alert alert-success"><b>Success: </b>{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error_message'))
        <div class="alert alert-danger"><b>Sorry: </b>{{ Session::get('error_message') }}</div>
        @endif

        <div id="table_data">
            {{ $data['html'] }}
        </div>

    </div>
</div>

@endsection