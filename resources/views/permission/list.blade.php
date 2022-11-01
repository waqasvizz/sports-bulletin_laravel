@section('title', 'Permission List')
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
                            <h4 class="card-title">Filter Permission</h4>
                        </div>
                        
                        <div class="card-body">
                            <form method="POST" id="permissionFilterform">
                                @csrf
                                <input name="page" id="permissionFltrPage" value="1" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
    
                                        <label class="form-label" for="select2-basic">Permission</label>
                                        <select class="permission_fltr select2 form-select" name="name" id="select2-permission">
                                            <option value=""> ---- Choose Permission ---- </option>
                                            @if (isset($data['permissions']) && count($data['permissions']) > 0 )
                                                @foreach ($data['permissions'] as $key => $perm_obj)
                                                    <option value="{{$perm_obj['name']}}">{{$perm_obj['name']}}</option>
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

        <div id="all_permissions">
            {{ $data['html'] }}
        </div>

    </div>
</div>

@endsection