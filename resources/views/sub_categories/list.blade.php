@section('title', 'Sub Categories List')
@extends('layouts.admin')

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
                            <h4 class="card-title">Filter Sub Categories</h4>
                        </div>
                        
                        <div class="card-body">
                            <form method="POST" id="subCatFilterform">
                                @csrf
                                <input name="page" id="subCatFltrPage" value="1" type="hidden">
                                <div class="row">
                                    <div class="col-md-6 mb-1">
        
                                        <label class="form-label" for="select2-basic">Category</label>
                                        <select class="sub_cat_fltr select2 form-select" name="category_id" id="select2-sub-cat">
                                            <option value=""> ---- Choose Category ---- </option>
                                            @foreach ($data['categories'] as $key => $cat_obj)
                                                <option value="{{$cat_obj['id']}}">{{$cat_obj['title']}}</option>
                                            @endforeach
                                        </select>
        
                                    </div>
                                    <div class="col-md-6 mb-1">
                                        
                                        <label class="form-label" for="select2-basic">Status</label>
                                        <select class="sub_cat_fltr select2 form-select" name="status" id="select2-account-sub-cat-status">
                                            <option value=""> ---- Choose Status ---- </option>
                                            @foreach ($data['statuses'] as $key => $status_obj) 
                                                <option value="{{$status_obj}}">{{$status_obj}}</option>
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

        <div id="all_sub_categories"></div>

    </div>
</div>

@endsection
