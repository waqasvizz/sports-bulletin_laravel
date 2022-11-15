@section('title', 'User List')
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
                            <h4 class="card-title">Filter Users</h4>
                        </div>
                        
                        <div class="card-body">
                            <form method="GET" id="filterForm" action="{{ url('/user') }}">
                                @csrf
                                <input name="page" id="filterPage" value="1" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 mb-1">

                                        <label class="form-label" for="select2-basic">Roles</label>
                                        <select class="formFilter select2 form-select" name="roles" id="select2-roles">
                                            <option value=""> ---- Choose Role ---- </option>
                                            @foreach ($data['all_roles'] as $key => $role_obj)
                                                <option value="{{$role_obj['name']}}">{{$role_obj['name']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div class="col-md-6 mb-1">
                                        <label class="form-label" for="select2-basic">Account Status</label>
                                        <select class="formFilter select2 form-select" name="user_status" id="select2-account-status">
                                            <option value=""> ---- Choose Status ---- </option>
                                            @foreach (Config::get('constants.statusActiveBlock') as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
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
